<?php

namespace App\Orchid\Screens\Capucin;

use App\Models\CpcnTableFields;
use App\Models\CpcnTables;
use App\Orchid\Layouts\Capucin\FieldEditLayout;
use App\Orchid\Layouts\Capucin\FieldTypeLayout;
use App\Services\Capucin\DBManager;
use App\Services\Capucin\ScreenManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\Radio;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Switcher;
use App\Models\CpcnLang;

class FieldEditScreen extends Screen
{
    /**
     * @var CpcnTables
     */
    public CpcnTables $table;
    /**
     * @var CpcnTableFields
     */
    public CpcnTableFields $field;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(CpcnTables $table, CpcnTableFields $field): iterable
    {
        //dd($table, $field);
        return [
            'table' => $table,
            'field' => $field,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->field->exists ? 'Edit Field' : 'Create Field';
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
                ->type(Color::DARK() )
                ->method($this->field->exists?'updateField':'createField'),
                //->canSee(!$this->field->exists),
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
            //---       Create field
            Layout::block(FieldEditLayout::class)
                ->title(__('The name of the field in the database table'))
                ->description(__('<lable style="color: red">In the future, it will not be possible to change.</lable>'))
                ->canSee(!$this->field->exists)
                ->commands(
                    Button::make(__('Save'))
                        ->icon('check')
                        ->type(Color::DARK())
                        ->method('createField'),
                ),
            //---       Lang Tabs Field Information
            Layout::block( $this->fieldEditInfo_tabs($this->field->exists) )
                ->title(__('Display Field Information.'))
                ->description(__('Field translate params (name and description).'))
                ->commands(
                    Button::make(__('Save'))
                        ->icon('check')
                        ->type(Color::DARK())
                        ->method($this->field->exists?'updateField':'createField')
                ),

            //---       Type Display Format Modal
            /*Layout::modal('selectDisplayFormatModal', $this->getDisplayFormatList())
                ->title('Select Display Format'),*/



        ];
    }

    //***************************************************************

    /**
     * @param Request $request
     * @param CpcnTableFields $field
     */
    public function createField(Request $request, CpcnTables $table){
        $createDBField = DBManager::createField($table, $request['field'] );
        if($createDBField){
            $field = new CpcnTableFields();
            $field['table_id'] = $table->id;
            $field['name'] = $request['field']['name'];
            $field['localization'] = $request['field']['localization'];
            $field['type'] = $request['field']['type'];
            $field->save();
            ScreenManager::createField($table);
            return redirect()->route('Capucin.TableList.table.edit', ['table' => $table->id]);
        }else{
            //Alert::error(__('Error! Crn`t create field.'));
            Toast::warning(__('Error! Crn`t create field.'));
        }
    }

    /**
     * @param Request $request
     * @param CpcnTables $table
     * @param CpcnTableFields $field
     */
    public function updateField(Request $request, CpcnTables $table, CpcnTableFields $field){
        $field['localization'] = $request['field']['localization'];
        $field['type'] = $request['field']['type'];
        $field->save();
        ScreenManager::makeLocalization($table->id);
        ScreenManager::makeLayouts($table->id);
        Toast::info(__('Save Field Info!'));
    }

    /**
     * @return \Orchid\Screen\Layouts\Tabs
     */
    public function fieldEditInfo_tabs($fieldExists){
        $fieldEditInfo_tabs = [];
        $dataListTableOption = [];
        $tableList = CpcnTables::filters()->defaultSort('id')->get();
        foreach ($tableList as $table){
            $dataListTableOption[$table['name']] = $table['localization']['name'][App::getLocale()];
        }
        //if(!$fieldExists){
            $fieldEditInfo_tabs[mb_strtoupper('<b>FORMAT</b>')][] = Layout::rows([
                                                                                 Select::make('field.type.displayFormat')
                                                                                     ->options([
                                                                                                   "text" => "Text",
                                                                                                   "email" => "Email (bootstrap@example.com)",
                                                                                                   "url" => "Url (https://getbootstrap.com)",
                                                                                                   "tel" => "Telephone (1-(555)-555-5555)",
                                                                                                   "number" => "Number",
                                                                                                   "date_and_time" => "Date and time",
                                                                                                   "date" => "Date",
                                                                                                   "time" => "Time (13:45:00)",
                                                                                                   "month" => "Month (2011-08)",
                                                                                                   "week" => "Week (2011-W33)",
                                                                                                   "status_yn" => "Status Y/N",
                                                                                                   "color" => "Color (#563d7c)",
                                                                                                   "datalist_One" => "Select",
                                                                                                   "datalist_Many" => "Multiple select",
                                                                                               ])
                                                                                     ->title(__('Display Format'))
                                                                                     ->help(__('Choose the display format')),
                                                                                 Select::make('field.type.dataListTable')
                                                                                     ->options($dataListTableOption)
                                                                                     ->empty('No select', 0)
                                                                                     ->title(__('Data list table'))
                                                                                     ->help(__('Choose data list table')),
                                                                                 /*Select::make('field.type.dataListField')
                                                                                     ->options([])
                                                                                     ->title(__('Data list field'))
                                                                                     ->help(__('Choose Data list field')),*/

                                                                                 Switcher::make('field.type.nullable')
                                                                                     ->sendTrueOrFalse()
                                                                                     ->title(__('Nullable'))
                                                                                     //->placeholder('$tableNameLang.$fieldName.title')
                                                                                     //->help('$tableNameLang.$fieldName.description')
                                                                                     ->horizontal(),
                                                                             ]);
        //}
        if(null == Session::get('all_langs')){
            $all_langs = CpcnLang::select(['code', 'name', 'active'])->get()->toArray();
            Session::put('all_langs', $all_langs);
        }

        foreach (Session::get('all_langs') as $lang) {
            $tabKey = $lang['active']==1?'<b>'.$lang['code'].'</b>':$lang['code'];
            $fieldEditInfo_tabs[mb_strtoupper($tabKey)][] = Layout::rows([
                                                                             Input::make('field.localization.name.'.$lang['code'])
                                                                                 ->type('text')
                                                                                 ->required()
                                                                                 ->title('Name')
                                                                                 ->placeholder('Name'),

                                                                             Input::make('field.localization.description.'.$lang['code'])
                                                                                 ->type('text')
                                                                                 ->required()
                                                                                 ->title('description')
                                                                                 ->placeholder('description'),
                                                                         ]);
        }


        $tabs = Layout::tabs( $fieldEditInfo_tabs );
        return $tabs;
    }

    public function fieldTypeTabs(){
        $fieldType_tabs[__('Type')][] = Layout::rows([
                                                         $this->fieldTypeSelect(),
                                                         Input::make('field.size')
                                                             ->type('number')
                                                             ->title('Size')
                                                             ->value(0)
                                                             ->horizontal(),
                                                     ]);

        $fieldType_tabs[__('Catalog')][] = Layout::rows([
                                                            Input::make('table.localization.name.ua')
                                                                ->type('text')
                                                                ->required()
                                                                ->title('Name 1')
                                                                ->placeholder('Name 1'),

                                                            Input::make('table.localization.description.ua')
                                                                ->type('text')
                                                                ->required()
                                                                ->title('description 1')
                                                                ->placeholder('description 1'),
                                                        ]);
        return Layout::tabs( $fieldType_tabs );
    }

    /**
     * @return Select
     */
    public function fieldTypeSelect(){
        return Select::make('field.type')
                ->options([
                              //'INT'   => 'INT'."\n".' ('.__('fieldTypeDescription.INT').')',
                              'INT'   => 'INT',
                              'VARCHAR' => 'VARCHAR',
                              'TEXT' => 'TEXT',
                              'DATE' => 'DATE',
                              __('Числовые') => [
                                  'TINYINT' => 'TINYINT',
                                  'SMALLINT' => 'SMALLINT',
                                  'MEDIUMINT' => 'MEDIUMINT',
                                  //'INT' => 'INT ('.__('fieldTypeDescription.').')',
                                  'BIGINT' => 'BIGINT',
                                  'disabled_1' => '-',
                                  'DECIMAL' => 'DECIMAL',
                                  'FLOAT' => 'FLOAT',
                                  'DOUBLE' => 'DOUBLE',
                                  'REAL' => 'REAL',
                                  'disabled_11' => '-',
                                  'BIT' => 'BIT',
                                  'BOOLEAN' => 'BOOLEAN',
                                  'SERIAL' => 'SERIAL',
                              ],
                              __('Дата и время') => [
                                  //'DATE' => 'DATE',
                                  'DATETIME' => 'DATETIME',
                                  'TIMESTAMP' => 'TIMESTAMP',
                                  'TIME' => 'TIME',
                                  'YEAR' => 'YEAR',
                              ],
                              __('Символьные') => [
                                  'CHAR' => 'CHAR',
                                  //'VARCHAR' => 'VARCHAR',
                                  'disabled_2' => '-',
                                  'TINYTEXT' => 'TINYTEXT',
                                  //'TEXT' => 'TEXT',
                                  'MEDIUMTEXT' => 'MEDIUMTEXT',
                                  'LONGTEXT' => 'LONGTEXT',
                                  'disabled_3' => '-',
                                  'BINARY' => 'BINARY',
                                  'VARBINARY' => 'VARBINARY',
                                  'disabled_4' => '-',
                                  'TINYBLOB' => 'TINYBLOB',
                                  'BLOB' => 'BLOB',
                                  'MEDIUMBLOB' => 'MEDIUMBLOB',
                                  'LONGBLOB' => 'LONGBLOB',
                                  'disabled_5' => '-',
                                  'ENUM' => 'ENUM',
                                  'SET' => 'SET',
                                  'disabled_6' => '-',
                                  'INET6' => 'INET6',
                              ],
                              __('Пространственные') => [
                                  'GEOMETRY' => 'GEOMETRY',
                                  'POINT' => 'POINT',
                                  'LINESTRING' => 'LINESTRING',
                                  'POLYGON' => 'POLYGON)',
                                  'MULTIPOINT' => 'MULTIPOINT',
                                  'MULTILINESTRING' => 'MULTILINESTRING',
                                  'MULTIPOLYGON' => 'MULTIPOLYGON',
                                  'GEOMETRYCOLLECTION' => 'GEOMETRYCOLLECTION',
                              ],
                              __('JSON') => [
                                  'JSON' => 'JSON',
                              ],
                          ])
                //->multiple()
                ->title(__('Field Type'))
                ->help(__('Choose the right type'))
            /*<select class="column_type" name="field_type[0]" id="field_0_2">
                <option title="Четырех-байтовое целое число, диапазон чисел со знаком от -2,147,483,648 до 2,147,483,647, диапазон чисел без знака от 0 до 4,294,967,295">
                    INT</option>
                <option title="Строка переменной длины (0-65,535), эффективная максимальная длина зависит от максимального размера строки">
                    VARCHAR</option>
                <option title="Столбец типа TEXT с максимальной длиной 65,535 (2^16 - 1) символов, сохраняется с двух-байтовым префиксом, указывающим длину значения в байтах">
                    TEXT</option>
                <option title="Дата, поддерживаемый диапазон от 1000-01-01 до 9999-12-31">
                    DATE</option>
            <optgroup label="Числовые">
                <option
                 title="Одно-байтовое целое число, диапазон чисел со знаком от -128 до 127, диапазон чисел без знака от 0 до 255">
                    TINYINT</option>
                <option
                 title="Двух-байтовое целое число, диапазон чисел со знаком от -32,768 до 32,767, диапазон чисел без знака от 0 до 65,535">
                    SMALLINT</option>
                <option
                 title="Трех-байтовое целое число, диапазон чисел со знаком от -8,388,608 до 8,388,607, диапазон чисел без знака от 0 до 16,777,215">
                    MEDIUMINT</option>
                <option
                 title="Четырех-байтовое целое число, диапазон чисел со знаком от -2,147,483,648 до 2,147,483,647, диапазон чисел без знака от 0 до 4,294,967,295">
                    INT</option>
                <option
                 title="Восьми-байтовое целое число, диапазон чисел со знаком от -9,223,372,036,854,775,808 до 9,223,372,036,854,775,807, диапазон чисел без знака от 0 до 18,446,744,073,709,551,615">
                    BIGINT</option>
                <option
                    disabled="disabled">-</option>
                <option
                 title="Число с фиксированной точкой (M, D) - максимальное количество цифр (M) не должно превышать 65 (по умолчанию 10), максимальное количество десятичных знаков после запятой (D) не должно превышать 30 (по умолчанию 0)">
                    DECIMAL</option>
                <option
                 title="Малое число с плавающей точкой, допустимые значения от -3.402823466E+38 до -1.175494351E-38, 0, и от 1.175494351E-38 до 3.402823466E+38">
                    FLOAT</option>
                <option
                 title="Число с плавающей точкой удвоенной точности, допустимые значения от -1.7976931348623157E+308 до -2.2250738585072014E-308, 0, и от 2.2250738585072014E-308 до 1.7976931348623157E+308">
                    DOUBLE</option>
                <option
                 title="Синоним для DOUBLE (исключение: в режиме REAL_AS_FLOAT SQL будет синоним для FLOAT)">
                    REAL</option>
                <option
                 disabled="disabled">-</option>
                <option
                 title="Тип поля-бит (M), сохранит M бит для значения (по умолчанию 1, максимум 64)">
                    BIT</option>
                <option
                 title="Синоним для TINYINT(1), значение нуля предполагает false, ненулевые значения предполагают true">
                    BOOLEAN</option>
                <option
                 title="Псевдоним для BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE">
                    SERIAL</option></optgroup>
            <optgroup label="Дата и время">
                <option
                 title="Дата, поддерживаемый диапазон от 1000-01-01 до 9999-12-31">
                    DATE</option>
                <option
                 title="Совмещение даты и времени, поддерживаемый диапазон от " 1000-01-01="" 00:00:00"="" до="" "9999-12-31="" 23:59:59""="">
                    DATETIME</option>
                <option
                 title="Временная метка, диапазон от " 1970-01-01="" 00:00:01"="" utc="" до="" "2038-01-09="" 03:14:07"="" utc,="" содержит="" количество="" секунд="" прошедших="" со="" времени="" ("1970-01-01="" 00:00:00"="" utc)"="">
                    TIMESTAMP</option>
                <option
                 title="Время, диапазон от -838:59:59 до 838:59:59">
                    TIME</option>
                <option
                 title="Год в четырехзначном (4, по умолчанию) или двухзначном (2) формате, допустимые значения от 70 (1970) до 69 (2069) или от 1901 до 2155 и 0000">
                    YEAR</option></optgroup>
            <optgroup label="Символьные">
                <option
                 title="Строка фиксированной длины (0-255, по-умолчанию 1), при хранении всегда дополняется пробелами в конце строки до заданной длины">
                    CHAR</option>
                <option
                 title="Строка переменной длины (0-65,535), эффективная максимальная длина зависит от максимального размера строки">
                    VARCHAR</option>
                <option
                 disabled="disabled">-</option>
                <option
                 title="Столбец типа TEXT с максимальной длиной 255 (2^8 - 1) символов, сохраняется с одно-байтовым префиксом, указывающим длину значения в байтах">
                    TINYTEXT</option>
                <option
                 title="Столбец типа TEXT с максимальной длиной 65,535 (2^16 - 1) символов, сохраняется с двух-байтовым префиксом, указывающим длину значения в байтах">
                    TEXT</option>
                <option
                 title="Столбец типа TEXT с максимальной длиной 16,777,215 (2^24 - 1) символов, сохраняется с трех-байтовым префиксом, указывающим длину значения в байтах">
                    MEDIUMTEXT</option>
                <option
                 title="Столбец типа TEXT с максимальной длиной 4,294,967,295 или 4ГиБ (2^32 - 1) символов, сохраняется с четырех-байтовым префиксом, указывающим длину значения в байтах">
                    LONGTEXT</option>
                <option
                 disabled="disabled">-</option>
                <option
                 title="Аналогичен типу CHAR, но предназначен для хранения бинарных байт-строк, вместо не бинарных символьных строк">
                    BINARY</option>
                <option
                 title="Аналогичен типу VARCHAR, но предназначен для хранения бинарных байт-строк, вместо не бинарных символьных строк">
                    VARBINARY</option>
                <option
                 disabled="disabled">-</option>
                <option
                 title="Столбец типа BLOB с максимальной длиной 255 (2^8 - 1) байт, сохраняется с одно-байтовым префиксом, указывающим длину значения">
                    TINYBLOB</option>
                <option
                 title="Столбец типа BLOB с максимальной длиной 65,535 (2^16 - 1) байт, сохраняется с двух-байтовым префиксом, указывающим длину значения">
                    BLOB</option>
                <option
                 title="Столбец типа BLOB с максимальной длиной 16,777,215 (2^24 - 1) байт, сохраняется с трех-байтовым префиксом, указывающим длину значения">
                    MEDIUMBLOB</option>
                <option
                 title="Столбец типа BLOB с максимальной длиной 4,294,967,295 или 4ГиБ (2^32 - 1) байт, сохраняется с четырех-байтовым префиксом, указывающим длину значения">
                    LONGBLOB</option>
                <option
                 disabled="disabled">-</option>
                <option
                 title="Перечисляемый тип данных, который может содержать максимум 65,535 различных величин или специальную величину ошибки ''">
                    ENUM</option>
                <option
                 title="Единственное значение выбираемое из набора не более 64 членов">
                    SET</option>
                <option
                 disabled="disabled">-</option>
                <option
                 title="Intended for storage of IPv6 addresses, as well as IPv4 addresses assuming conventional mapping of IPv4 addresses into IPv6 addresses">
                    INET6</option></optgroup>
            <optgroup label="Пространственные">
                <option
                 title="Тип для хранения любого вида геометрических данных">
                    GEOMETRY</option>
                <option
                 title="Точка в двухмерном пространстве">
                    POINT</option>
                <option
                 title="Кривая с линейной интерполяцией между точек">
                    LINESTRING</option>
                <option
                 title="Многоугольник">
                    POLYGON</option>
                <option
                 title="Набор точек">
                    MULTIPOINT</option>
                <option
                 title="Набор кривых с линейной интерполяцией между точками">
                    MULTILINESTRING</option>
                <option
                 title="Набор многоугольников">
                    MULTIPOLYGON</option>
                <option
             title="Набор геометрических объектов любого типа">
                    GEOMETRYCOLLECTION</option></optgroup>
            <optgroup label="JSON">
                <option
                 title="Тип данных для эффективного хранения и использования данных в JSON (JavaScript Object Notation)">
                    JSON</option></optgroup>
              </select>*/
        ;
    }




}
