<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Model\Omoide;
use App\Http\Requests\OmoideRequest;


class OmoideController extends Controller
{
    public static function getImagePath()
    {
        return 'omoide_photos';
    }
 
    public static function getImageFileName($id)
    {
        return $id . '.jpg';
    }

    public static function publicPath($path)
    {
        return "public/".$path;
    }

    public static function getImageFilePath($id)
    {
        return $this->publicPath($this->getImagePath) . "/" . $this->getImageFileName($id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('omoide.index', ['omoides' => Omoide::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('omoide.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\OmoideRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OmoideRequest $request)
    {
        $omoide = new Omoide;
        $omoide->fill([
            'content' => $request->content,
        ])->save();
        if(!empty($request->photo)){
            $omoideId = $omoide->id;
            $request->photo->storeAs($this->publicPath($this->getImagePath()),$this->getImageFileName($omoideId));
            $omoide->fill([
                'image_path' => $this->getImageFilePath($omoideId),
            ])->save();
        }
        return redirect(route('omoide.index'))->with('success','新しい思い出を登録しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $omoide = Omoide::find($id);
        $imageFilePath = $this->publicPath($this->getImagePath()) . "/" . $this->getImageFileName($id);
        if(Storage::exists($imageFilePath)){
            Storage::delete($imageFilePath);
        }
        $omoide->delete();
        return redirect(route('omoide.index'));
    }
}
