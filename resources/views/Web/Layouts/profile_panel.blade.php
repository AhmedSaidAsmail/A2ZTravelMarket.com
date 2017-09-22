<ul class="list-group list-group-sp">
    <li class="list-group-item {{($active=="profile")?"active":""}}">
        <a href="{{route('customer.profile')}}"><i class="fa fa-user"></i> Profile</a>
    </li>
    <li class="list-group-item {{($active=="password")?"active":""}}">
        <a href="{{route('customer.password')}}"><i class="fa fa-lock"></i> Password</a>
    </li>
    <li class="list-group-item">
        <a href=""><i class="fa fa-cog"></i> Preferences</a>
    </li>
</ul>