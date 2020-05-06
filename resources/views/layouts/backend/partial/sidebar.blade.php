<aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="/assets/backend/images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
                    <div class="email">{{Auth::user()->email}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                           
                            <li><a href="{{Auth::user()->role_id == 1 ? route('admin.settings') : route('author.settings')}}"><i class="material-icons">settings</i>Настройки</a></li>
}
                            <li role="separator" class="divider"></li>
                            <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons">input</i>Отлогиниться
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            
                            
                            
                            
                            
                            
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">ОСНОВНАЯ НАВИГАЦИЯ</li>



        @if(Request::is('admin*'))


        <li class="{{Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{route('admin.dashboard')}}">
                            <i class="material-icons">dashboard</i>
                            <span>ДОСКА АДМИНА</span>
                        </a>
                    </li>
                    <li class = "header">System </li>



                    <li class="{{Request::is('admin/tag*') ? 'active' : '' }}">
                        <a href="{{route('admin.tag.index')}}">
                            <i class="material-icons">label</i>
                            <span>ТЭГИ</span>
                        </a>
                    </li>



                    <li class="{{Request::is('admin/category*') ? 'active' : '' }}">
                        <a href="{{route('admin.category.index')}}">
                            <i class="material-icons">apps</i>
                            <span>КАТЕГОРИИ</span>
                        </a>
                    </li>


                    <li class="{{Request::is('admin/post*') ? 'active' : '' }}">
                        <a href="{{route('admin.post.index')}}">
                            <i class="material-icons">library_books</i>
                            <span>ПОСТЫ</span>
                        </a>
                    </li>


                    
                    <li class="{{Request::is('admin/pending/post') ? 'active' : '' }}">
                        <a href="{{route('admin.post.pending')}}">
                            <i class="material-icons">library_books</i>
                            <span>ПОСТЫ НА УТВЕРЖДЕНИИ</span>
                        </a>
                    </li>


                    <li class="{{Request::is('admin/comments') ? 'active' : '' }}">
                        <a href="{{route('admin.comment.index')}}">
                            <i class="material-icons">comment</i>
                            <span>ВСЕ КОММЕНТАРИИ</span>
                        </a>
                    </li>


                    <li class="{{Request::is('admin/author') ? 'active' : '' }}">
                        <a href="{{route('admin.author.index')}}">
                            <i class="material-icons">account_circle</i>
                            <span>ВСЕ АВТОРЫ</span>
                        </a>
                    </li>


                    <li class="{{Request::is('admin/subscriber') ? 'active' : '' }}">
                        <a href="{{route('admin.subscriber.index')}}">
                            <i class="material-icons">subscriptions</i>
                            <span>ВСЕ ПОДПИСЧИКИ</span>
                        </a>
                    </li>








                    <li class = "header">System</li>


                    <li class="{{Request::is('admin/settings') ? 'active' : '' }}">
                        <a href="{{route('admin.settings')}}">
                            <i class="material-icons">settings</i>
                            <span>НАСТРОЙКИ АДМИНА</span>
                        </a>
                    </li>




        <li> 
                         <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons">input</i>
                                        <span>ОТЛОГИНИТЬСЯ</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                    </li>

        
        
        
        
        
        
        
        
        
        
        
        @endif


        @if(Request::is('author*'))


        <li class="{{Request::is('author/dashboard') ? 'active' : '' }}">
                        <a href="{{route('author.dashboard')}}">
                            <i class="material-icons">dashboard</i>
                            <span>ДОСКА АВТОРА</span>
                        </a>
                    </li>

                    <li class="{{Request::is('author/post*') ? 'active' : '' }}">
                        <a href="{{route('author.post.index')}}">
                            <i class="material-icons">library_books</i>
                            <span>ПОСТЫ</span>
                        </a>
                    </li>

                    <li class="{{Request::is('author/comments') ? 'active' : '' }}">
                        <a href="{{route('author.comment.index')}}">
                            <i class="material-icons">comment</i>
                            <span>ВСЕ КОММЕНТАРИИ</span>
                        </a>
                    </li>

                    <li class = "header">System</li>

                    <li class="{{Request::is('author/settings') ? 'active' : '' }}">
                        <a href="{{route('author.settings')}}">
                            <i class="material-icons">settings</i>
                            <span>НАСТРОЙКИ ПОЛЬЗОВАТЕЛЯ</span>
                        </a>
                    </li>

        <li> 
                         <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons">input</i>
                                        <span>ОТЛОГИНИТЬСЯ</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                    </li>
        @endif













 
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2020 <a href="javascript:void(0);">KARNURMAX</a>
                </div>

            </div>
            <!-- #Footer -->
        </aside>