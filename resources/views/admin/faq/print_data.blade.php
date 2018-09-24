<table border="1" style="border-collapse:collapse; max-width: 100%;">
    <tr>
        <th>id</th>
        <th>question</th>
        <th>answer</th>
        <th>status</th>
        <th>created_at</th>
        <th>updated_at</th>
   
    <tr>
    @foreach($faqs as $faq)
    <tr>
        <td>{{$faq->id}}</td>
        <td>{{$faq->question}}</td>
        <td>{{$faq->answer}}</td>
        <td>{{$faq->status}}</td>
        <td>{{$faq->created_at}}</td>
        <td>{{$faq->updated_at}}</td>
    </tr>
    @endforeach
</table>

<script type="text/javascript">
window.print();
</script>