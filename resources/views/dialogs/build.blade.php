<div id="win-build" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Build</h4>
            </div>
            <div class="modal-body">
                <table class='table table-bordered table-selectable'>
                    @foreach ($building_types as $item)
                    <tr class="clickable-row">
                        <td>
                            <div style="float: left">
                                <img src="{{$item->image_src}}" class="facade"/>
                            </div>
                            <div>
                                {{$item->title}} <br />
                                {{$item->description}} <br />
                                Cost: <br />
                                <div class="price">
                                Food: {{$item->cost_food}} | Wood: {{$item->cost_wood}} | Stone: {{$item->cost_stone}} | Gold: {{$item->cost_gold}}
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    
                    <tr class="clickable-row disabled">
                        <td>
                           asdsasad
                        </td>
                    </tr>

                    
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Build</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>