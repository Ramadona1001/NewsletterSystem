<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@lang('tr.Update Role')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form style="padding:20px;" action="{{ route('UpdateRolesPost') }}" method="POST">
                    @csrf
                        <input type="hidden" name="id" class="role_id" value="{{ $role->id }}">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">@lang('tr.Name')</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control role_name" value="{{ $role->name }}" name="name" type="text" placeholder="@lang('tr.Name')" required>
                            </div>
                        </div>



      </div>
      <div class="modal-footer">
            <input type="submit" value="@lang('tr.Save Role')" class="btn btn-primary col-sm-12 col-md-12">
        </form>
      </div>
    </div>
  </div>
</div>

