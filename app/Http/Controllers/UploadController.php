<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SkinUploadRequest;

class UploadController extends Controller
{
    public function skin(SkinUploadRequest $request)
    {
        $file = public_path('files/skins/' . \Auth::user()->username . '.png');

        if (file_exists($file))
            unlink($file);

        move_uploaded_file($request->file('skin')->getRealPath(), $file);

        activity('Profil módosítás')->log('Skin feltöltés');

    	return redirect()->back();
    }

    public function removeSkin()
    {

    	$file = public_path('files/skins/' . \Auth::user()->username . '.png');

    	if (file_exists($file))
    		unlink($file);

        activity('Profil módosítás')->log('Skin eltávolítása');

    	return redirect()->back();
    }
}