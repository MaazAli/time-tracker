<?php

class EntryController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// return 'Hello, API';
		$entries = Entry::where('user_id', Auth::user()->id)->get();

		return Response::json(array(
			'error' => false,
			'entries' => $entries->toArray()
		), 200);
	}




	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$entry = new Entry;
		$entry->user_id = Auth::user()->id;
		$entry->first_name = Auth::user()->first_name;
		$entry->minutes = Request::get('minutes');
		$entry->task = Request::get('task');
		$entry->notes = Request::get('notes');

		$entry->save();

		return Response::json(array(
			'error' => false,
			'message' => 'entry created'), 
			200
		);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// Get a specific one
		$entry = Entry::where('user_id', Auth::user()->id)
				->where('id', $id)
				->take(1)
				->get();

		return Response::json(array(
			'error' => false,
			'entries' => $entry->toArray()
			), 200);

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$entry = Entry::where('user_id', Auth::user()->id)->find($id);

		if ( Request::get('minutes') ) {
			$entry->minutes = Request::get('minutes');
		}

		if ( Request::get('task')) {
			$entry->task = Request::get('task');
		}

		if ( Request::get('notes')) {
			$entry->notes = Request::get('notes');
		}

		$entry->save();

		return Response::json(array(
			'error' => false,
			'message' => 'entry updated'
			), 200);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$entry = Entry::where('user_id', Auth::user()->id)->find($id);

		$entry->delete();

		return Response::json(array(
			'error' => false,
			'message' => 'entry deleted'
			), 200);
	}


}
