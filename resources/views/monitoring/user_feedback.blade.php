<div class="modal fade show-feedback" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="user-feedback-by"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="feedback-form" action="{{ route('monitoring.store_feedback') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $tipe_monitoring }}" name="tipe_monitoring"/>
                    <input type="hidden" value="" name="data_id" id="user-feedback-data-id"/>
                    <div class="form-group">
                        <textarea name="feedback" class="form-control @error('feedback') is-invalid @enderror" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
                <div id="user-feedback"></div>
            </div>
        </div>
    </div>
</div>
<script>
    function handle_user_feedback(e)
    {
        let feedback_text = $(e).attr("user-feedback");
        let feedback_by = $(e).attr("user-feedback-by");
        if (!feedback_text) {
            $("#feedback-form").show();
            $("#user-feedback-data-id").val($(e).attr("user-data-id"));
            $("#user-feedback").html("");
            $("#user-feedback-by").html("Isi Feedback");
        } else {
            $("#feedback-form").hide();
            $("#user-feedback").html(feedback_text);
            $("#user-feedback-by").html("Feedback dari "+feedback_by);
        }
    }
</script>
