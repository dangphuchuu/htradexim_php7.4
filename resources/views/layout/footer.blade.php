<footer >
    @foreach($footers as $value)
        <img src="upload/footers/{!! $value['image'] !!}" alt="" width="100%">
    @endforeach
    </footer>