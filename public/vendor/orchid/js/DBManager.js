document.addEventListener('DOMContentLoaded', function () {
    // init lightslider


    //console.log($("[name='field[type][displayFormat]']"));

    //$('field[type][displayFormat]')
    //let tableSelect = $("[name='field[type][dataListTable]']");
    //let fieldSelect = $("[name='field[type][dataListField]']");
    /*$("[name='field[type][displayFormat]']").change(function() {
        //console.log( $( this ).val() );
        if($( this ).val() == 'datalist'){
            $("#"+$("[name='field[type][dataListField]']").attr('id')+"-ts-dropdown").prop( "disabled", false );
        }else{
            $("#"+$("[name='field[type][dataListField]']").attr('id')+"-ts-dropdown").prop( "disabled", true );
        }
    });*/
    //$("[name='field[type][dataListTable]']").change(function() {

        //console.log( $( this ).val() );



        /*$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            }
        });*/

        /*$.ajax({
            type:'POST',
            url:"/ajax/getFieldsByTable",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            data:{
                table:$( this ).val()
                //name:name, password:password, email:email
                },
            success:function(fields){
                $("[name='field[type][dataListField]']").empty();
                let dataListId = $("[name='field[type][dataListField]']").attr('id');
                let npp = 0;
                let selected = 'aria-selected="true"';
                let selectedclassName = 'selected';
                $.each( fields, function( key, field ) {
                    npp++;
                    //console.log($("[name='field[type][dataListField]']").attr('id'));
                    $("[name='field[type][dataListField]']").append('<option value="'+key+'">'+field+'</option>');
                    $("#"+dataListId+"-ts-dropdown").append('<div data-selectable="" data-value="'+key+'" className="option active '+selectedclassName+'"\n' +
                        '                             role="option"\n' +
                        '                             id="'+dataListId+'-opt-'+npp+'"\n' +
                        '                             '+selected+'>' +
                        '                             ' + field +
                        '                        </div>');

                    selected = '';
                    selectedclassName = '';



                });
            }
        });*/


    //});

}, false);


/*<div
    className="ts-wrapper form-control single plugin-change_listener input-hidden full has-items disabled locked preloaded">
    <div className="ts-control">
        <div data-value="TEST_Table_1" className="item" data-ts-item="">TEST Table #1</div>
        <input type="select-one" autoComplete="off" size="1" tabIndex="-1" role="combobox" aria-haspopup="listbox"
               aria-expanded="false"
               aria-controls="field-fieldtypedatalisttable-32504dee9243c8ebb25fc24f68742252e8a1b998-ts-dropdown"
               id="field-fieldtypedatalisttable-32504dee9243c8ebb25fc24f68742252e8a1b998-ts-control"
               aria-labelledby="field-fieldtypedatalisttable-32504dee9243c8ebb25fc24f68742252e8a1b998-ts-label"
               disabled=""></div>
    <div className="ts-dropdown single plugin-change_listener" style="display: none;">
        <div role="listbox" tabIndex="-1" className="ts-dropdown-content"
             id="field-fieldtypedatalisttable-32504dee9243c8ebb25fc24f68742252e8a1b998-ts-dropdown"
             aria-labelledby="field-fieldtypedatalisttable-32504dee9243c8ebb25fc24f68742252e8a1b998-ts-label"></div>
    </div>
</div>
</div>*/
