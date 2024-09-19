<h2>
    {{ $job->title }}
</h2>
<p>
    Congrats! Your job is now live on our website.
</p>

<p>
    {{-- // User will not be inside the application so
    // we need to provide full website url --}}
    <a href="{{ url('/jobs/' . $job->id) }} ">View your job Listing</a> 
</p>