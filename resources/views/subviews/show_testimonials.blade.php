@foreach($testimonials as $testimony)
<div class='review-content'>
    <img class='center-block' src='{{url("images/no_user.jpg")}}'>
    <p class='name-para'>{{$testimony->user()->firstName}} {{$testimony->user()->lastName}}</p>
    <p class='country-para'>{{$testimony->user()->country}}</p>
    <h4 class='main-review'>
        <span class='in-quote'>“</span>
        {{$testimony->review}}
        <span class='in-quote'>”</span>
    </h4>
</div>
@endforeach