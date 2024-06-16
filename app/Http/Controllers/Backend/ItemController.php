<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('backend.item.index', compact('items'));
    }

    public function generateId()
    {
        //dd($request->all());
        try {
            $item = new Item();
            $item->user_id = Auth::user()->id;
            $item->save();

            $item_id = $item->id;
            if (! $item_id) {
                return redirect()->back();
            }
            return redirect()->route('item.editor', ['item_id' => $item_id]);
        }
        catch(Exception $e) {
            echo 'Generate ID Exception: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function editor($item_id)
    {
        $item_exists = Item::where('id', $item_id)->exists();
        if (! $item_exists) {
            return redirect()->route('item.index');
        }

        $item = Item::find($item_id);
        return view('backend.item.editor-codemirror', compact('item'));
    }

    public function saveCode(Request $request)
    {
        try{
            $itemId    = $request->input( 'itemId' );
            $htmlCode  = $request->input( 'htmlCode' );
            //dd($htmlCode);
            $item      = Item::find($itemId);
            if ($item)
            {
                $item->html = $htmlCode;
                $item->save();
                return response()->json(['success' => true]);
            }
            else {
                return response()->json(['success' => false]);
            }
        }
        catch(Exception $e) {
            echo 'Exception: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function edit($item_id)
    {
        $item = Item::find($item_id);

        return view('backend.item.edit', compact('item'));
    }

    public function update(Request $request, $item_id)
    {
        //dd($request->input('tags'));
        $request->validate([
            'price'         => 'required|numeric',
            'screenshot'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tags'          => 'required',
        ]);

        try {
            $item = Item::find($item_id);

            $item->price = $request->input('price');
            $item->is_active = $request->has('is_active');
            $item->is_featured = $request->has('is_featured');
            $item->has_image = $request->has('has_image');
            if($request->hasFile('screenshot')) {
                $inputImage = $request->file('screenshot');
                $imageName = 'item-'. $item_id . '-' . time() . '.' . $inputImage->extension();
                $image_path = public_path('uploads/screenshots/'. $item->screenshot);
                // Delete old image
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $inputImage->move(public_path('uploads/screenshots/'), $imageName);
                $item->screenshot = $imageName;
            }
            $item->tags = $request->input('tags');
            $tag_items = explode(',', $request->input('tags'));

            $item->save();

            return redirect()->route('item.edit', $item->id )->with(['msg' => 'Item Updated Successfully', 'type' => 'success']);

        } catch (\Throwable $e) {
            //dd($e->getMessage());
            return redirect()->back()->with(['msg' => 'Something went wrong, please check and try again', 'type' => 'failed']);
        }
    }

    public function destroy($item_id)
    {
        $item = Item::find($item_id);
        $item->delete();
        return redirect()->route('item.index')->with(['msg' => 'Item Deleted Successfully', 'type' => 'success']);
    }
}
