<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@lang('tr.Send Message')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form style="padding:20px;" action="{{ route('SendContactMail') }}" method="POST">
                    @csrf
                        <p class="emailTxt" style="background: #cec9c991; padding: 5px; padding-left: 20px; border-radius: 10px;"></p>
                        <input type="hidden" class="toemail" name="email">
                        <input type="hidden" class="toname" name="toname">
                        <input type="text" name="subject" required class="form-control" placeholder="@lang('tr.Subject')"><br>
                        <textarea name="content" required id="content" cols="30" rows="5" class="form-control" placeholder="@lang('tr.Message')"></textarea>
                        



      </div>
      <div class="modal-footer">
            <input type="submit" value="@lang('tr.Send')" class="btn btn-primary col-sm-12 col-md-12">
        </form>
      </div>
    </div>
  </div>
</div>

