<?php

namespace App\Orchid\Screens\Capucin;

use App\Models\CpcnLang;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use App\Orchid\Layouts\Capucin\LangEditLayout;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class LangEditScreen extends Screen
{
    /**
     * @var CpcnLang
     */
    public $lang;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(CpcnLang $lang): iterable
    {
        /*if($lang->exists){
            $lang['active'] = $lang['active']==1?true:false;
        }*/
        return [
            'lang' => $lang,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'LangEditScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('check')
                ->type(Color::DARK())
                ->method('saveLang')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::block(LangEditLayout::class)
                ->title(__('Lang Information'))
                ->description(__('Update Lang Information.'))
                ->commands(
                    Button::make(__('Save'))
                        ->icon('check')
                        ->type(Color::DARK())
                        ->canSee($this->lang->exists)
                        ->method('saveLang')
                ),
        ];
    }

    /**
     * @param Request $request
     * @param CpcnLang $lang
     */
    public function saveLang(Request $request, CpcnLang $lang)
    {
        $request->validate([
                               'lang.code' => ['required', 'size:2',],
                               'lang.name' => ['required', 'max:50',],
                           ]);


        $lang->active = isset($request['lang']['active']);
        $lang->code = $request['lang']['code'];
        $lang->name = $request['lang']['name'];
        $lang->save();

        Toast::info(__('User was saved.'));
        return redirect()->route('Capucin.LangList');
    }


}
