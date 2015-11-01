<?php namespace App\Http\Controllers;

use App\EventDoc;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;

use Illuminate\Http\Request;

class EventController extends Controller {

    private $event;

    public function __construct(Event $event)
    {
        $this->middleware('auth');
        $this->event = $event;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $events = $this->event->paginate(10);
        return view('event.index')->with(compact('events'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('event.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $input =  $request->all();

        $postDocRow = [
            'docType' => 1,
            'docsUrl' => $input['docs_url'],
        ];
        if (\Input::hasFile('event_eyecatch_img')) {
            $image = \Input::file('event_eyecatch_img');
            $name = md5(sha1(uniqid(mt_rand(), true))). '.'. $image->getClientOriginalExtension();
            $upload = $image->move('media', $name);
//            \File::delete(public_path($this->user->thumbnail));
            $input['event_eyecatch_img'] = '/' . $upload;
        }
        unset($input['docs_url']);
        $this->event->fill($input);
        $this->event->save();
        // 資料を添付していれば資料を登録する
        if ($postDocRow['docsUrl'] !== '') {
            $postDocRow['eventsId'] = $this->event->id;
            EventDoc::postDocs($postDocRow);
        }

        return redirect()->to("/events/{$this->event->id}");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        try {
            $event = $this->event->findOrFail($id);
            if ('dummyimage.com' === parse_url($event->event_eyecatch_img, PHP_URL_HOST)) unset($event->event_eyecatch_img);
            $docs = EventDoc::getDocsByEventId($id);
            return view('event.show')->with(compact('event', 'docs'));
        } catch(\ModelNotFoundException $e){
            return \Response::view('errors.404', [], '404');
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
