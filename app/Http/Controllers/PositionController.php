<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::all();

        return view('admin.positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PositionRequest $request
     * @return Response
     */
    public function store(PositionRequest $request)
    {
        $data = array_merge($request->validated(), [
        'admin_created_id' => \Auth::user()->id,
        'admin_updated_id' => \Auth::user()->id,
        ]);

        Position::create($data);

        return redirect()->route('positions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Position $position
     * @return Response
     */
    public function edit(Position $position)
    {
        return view('admin.positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PositionRequest $request
     * @param Position $position
     * @return Response
     */
    public function update(PositionRequest $request, Position $position)
    {
        $data = array_merge($request->validated(), [
            'admin_updated_id' => \Auth::user()->id
        ]);
        $position->update($data);

        return redirect()->route('positions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Position $position
     * @return Response
     */
    public function destroy(Position $position)
    {
        $position->delete();

        return redirect(route('positions.index'));
    }
}
