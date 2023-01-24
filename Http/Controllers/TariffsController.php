<?php

namespace Modules\Tariffs\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Tariffs\Entities\Plan;

class TariffsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $items = Plan::all();

        return view('tariffs::index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('tariffs::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $plan = Plan::create([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'price' => $request->price,
                'day' => $request->day,
                'properties' => ($request->properties?serialize($request->properties):null),
            ]);

            return redirect()->route('tariffs.index')->with('flash_message', 'با موفقیت ثبت شد');
        }catch (\Exception $e){
            return redirect()->back()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('tariffs::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Plan $tariff)
    {
        return view('tariffs::edit', compact('tariff'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Plan $tariff)
    {
        try {
            $tariff->update([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'price' => $request->price,
                'day' => $request->day,
                'properties' => ($request->properties?serialize($request->properties):null),
            ]);

            return redirect()->route('tariffs.index')->with('flash_message', 'بروزرسانی با موفقیت انجام شد');
        }catch (\Exception $e){
            return redirect()->back()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Plan $tariff)
    {
        try {
            $tariff->delete();

            return redirect()->route('tariffs.index')->with('flash_message', 'با موفقیت حذف شد');
        }catch (\Exception $e){
            return redirect()->back()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }
}
