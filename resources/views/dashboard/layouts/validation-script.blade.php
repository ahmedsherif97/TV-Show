<script type="text/javascript">
    var csrf_token = document.head.querySelector('meta[name="csrf-token"]').getAttribute("content");
    showValidationErrors = function() {
        var errors = [];
        @if ($errors->getBag('default')->messages())
            errors = {!! json_encode($errors->getBag('default')->messages()) !!};
        @endif
        //console.log(errors)
        for (var key in errors) {
            let error = errors[key].join('<br>');
            var element = $('[name=' + key + ']')
            if (element.length != 1) element = $('[name^=' + key + ']')
            if (element.length != 1) console.log(error)
            if (element.attr('type') == " radio" || element.attr('type') == "checkbox") {
                element.closest("div").append('<span class="invalid-feedback"><strong>' + error +
                    '<strong/></span >').addClass("is-invalid");
            } else if (element.closest("div").hasClass("input-group")) {
                element.closest(".input-group").after('<span class="invalid-feedback"><strong>' + error +
                    '</strong></span>').addClass("is-invalid");
            } else {
                element.after('<span class="invalid-feedback"><strong>' + error + '</strong></span>').addClass(
                    "is-invalid");
            }
        }
    }()
</script>
