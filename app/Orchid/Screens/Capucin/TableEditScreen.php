<?php

namespace App\Orchid\Screens\Capucin;

use App\Models\CpcnTableFields;
//use App\Orchid\Layouts\Capucin\FieldEditLayout;
use App\Orchid\Layouts\Capucin\TableEditLayout;
use App\Orchid\Layouts\Capucin\FieldsListLayout;
use App\Orchid\Layouts\User\UserEditLayout;
use App\Services\Capucin\ScreenManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Toast;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use App\Models\CpcnTables;
use App\Models\CpcnLang;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use App\Services\Capucin\DBManager;
use Illuminate\Routing\Redirector;

class TableEditScreen extends Screen
{

    /**
     * @var CpcnTables
     */
    public CpcnTables $table;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(CpcnTables $table): iterable
    {
        return [
            'table' => $table,
            'fields' => CpcnTableFields::filters()
                ->where('table_id', $table['id'])
                ->defaultSort('id')
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->table->exists ? __('buttons.Edit Table') : __('buttons.Create Table');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('buttons.Add Field'))
                ->icon('plus')
                ->type(Color::DARK() )
                ->route('Capucin.TableList.table.field.create', ['table' => $this->table->exists?$this->table['id']:0])
                ->canSee($this->table->exists),

            Button::make(__('buttons.Save'))
                ->icon('check')
                ->type(Color::DARK() )
                ->method('createTable')
                ->canSee(!$this->table->exists),
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
//---       Create table
            Layout::block(TableEditLayout::class)
                ->title(__('buttons.The name of the table in the database'))
                ->description('<lable style="color: red">'.__('buttons.In the future, it will not be possible to change.').'</lable>')
                ->canSee(!$this->table->exists)
                ->commands(
                    Button::make(__('Save'))
                        ->icon('check')
                        ->type(Color::DARK())
                        ->method('createTable'),
                ),
//---       Lang Tabs Table Information
            Layout::block( $this->tableEditInfo_tabs() )
            ->title(__('buttons.Table Information.'))
            ->description(__('Table translate params (name and description).'))
            //->canSee($this->table->exists)
            ->commands(
                Button::make(__('Save'))
                    ->icon('check')
                    ->type(Color::DARK())
                    ->method($this->table->exists?'updateTable':'createTable')
            ),
//---       Fields list
            Layout::block(FieldsListLayout::class)
                ->commands(
                    Link::make(__('buttons.Add Field'))
                        ->icon('plus')
                        ->type(Color::DARK() )
                        ->route('Capucin.TableList.table.field.create', ['table' => $this->table->exists?$this->table['id']:0])
                        ->canSee($this->table->exists),
                )
                ->vertical()
                ->title(__('Fiield list'))
                ->canSee($this->table->exists),

        ];
    }

    /**
     * @param Request $request
     * @param CpcnTables $table
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createTable(Request $request, CpcnTables $table)
    {
        $createDBTable = DBManager::createTable($request['table']['name']);
        if($createDBTable){
            $table['name'] = $request['table']['name'];
            $table['localization'] = $request['table']['localization'];
            $table->save();
            ScreenManager::createTable($table);
            return redirect()->route('Capucin.TableList.table.edit', ['table' => $table->id]);
        }else{
            Toast::warning(__('Error! Crn`t create table.'));
        }

    }

    /**
     * @param Request $request
     * @param CpcnTables $table
     */
    public function updateTable(Request $request, CpcnTables $table){
        $table['localization'] = $request['table']['localization'];
        $table->save();
        ScreenManager::makeLocalization($table->id);
    }

    /**
     * @return \Orchid\Screen\Layouts\Tabs
     */
    public function tableEditInfo_tabs(){
        $tableEditInfo_tabs = [];
        foreach (Session::get('all_langs') as $lang) {
            $tabKey = $lang['active']==1?'<b>'.$lang['code'].'</b>':$lang['code'];
            $tableEditInfo_tabs[mb_strtoupper($tabKey)][] = Layout::rows([
                                                                     Input::make('table.localization.name.'.$lang['code'])
                                                                         ->type('text')
                                                                         ->required()
                                                                         ->title('Name')
                                                                         ->value("")
                                                                         ->placeholder('Name'),

                                                                     Input::make('table.localization.description.'.$lang['code'])
                                                                         ->type('text')
                                                                         ->required()
                                                                         ->title('Description')
                                                                         ->value("")
                                                                         ->placeholder('description'),
                                                                 ]);
        }

        $tabs = Layout::tabs( $tableEditInfo_tabs );
        return $tabs;
    }

}
