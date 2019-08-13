<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="{{ asset('js/vendor/jquery-3.4.1.min.js') }}"></script>

<script src="{{ asset('js/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('js/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('js/jquery.fileupload.js') }}"></script>

<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>

<!-- Include this after the sweet alert js file -->
@include('sweet::alert')

