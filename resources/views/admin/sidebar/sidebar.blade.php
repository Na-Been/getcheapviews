<!doctype html>
@if(modeSelector() == 0)
    <html lang="en" class="light">
    @else
        <html lang="en" class="dark">
        @endif
        <head>
            <meta charset="utf-8">
            @if($setting)
                @if($setting->logo != null)
                    <link href="{{url('/').Storage::url($setting->logo)}}" rel="shortcut icon">
                @else
                    <link rel="icon" href="{{asset('assets/image_placeholder.webp')}}">
                @endif
            @endif
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description"
                  content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
            <meta name="keywords"
                  content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
            <meta name="author" content="LEFT4CODE">
            <title>{{$setting->title ?? null}} | @yield('title')</title>
            <!-- END: CSS Assets-->
            <link rel="stylesheet"
                  href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
            <!-- select 2 -->
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
            <!-- BEGIN: CSS Assets-->
            <link rel="stylesheet" href="{{asset('dist/css/app.css')}}"/>
            <link rel="stylesheet" href="{{asset('assets/styles/table.css')}}"/>
            <link rel="stylesheet" href="{{asset('dist/css/toastr.min.css')}}"/>
        </head>
        <body class="app">
        @section('sidebar')
            <!-- BEGIN: Mobile Menu -->
            <div class="mobile-menu md:hidden">
                <div class="mobile-menu-bar">
                    <a href="" class="flex mr-auto">
                        <img alt="Midone Tailwind HTML Admin Template" class="w-6"
                             src="{{asset('dist/images/logo.svg')}}">
                    </a>
                    <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2"
                                                                        class="w-8 h-8 text-white transform -rotate-90"></i>
                    </a>
                </div>
                <ul class="border-t border-theme-24 py-5 hidden">
                    <li>
                        <a href="{{route('admin.index')}}"
                           class="side-menu {{request()->routeIs('admin.index')? 'side-menu--active' : ' '}}">
                            <div class="side-menu__icon"><i data-feather="home"></i></div>
                            <div class="side-menu__title"> Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('all.orders')}}"
                           class="side-menu {{request()->routeIs('all.orders') ? 'side-menu--active' : ''}}">
                            <div class="side-menu__icon"><i data-feather="sliders"></i></div>
                            <div class="side-menu__title"> All Orders</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('slider.index')}}"
                           class="side-menu {{request()->routeIs('slider.index') || request()->routeIs('slider.create')? 'side-menu--active' : ''}}">
                            <div class="side-menu__icon"><i data-feather="sliders"></i></div>
                            <div class="side-menu__title"> Slider</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('blog.index')}}"
                           class="side-menu {{request()->routeIs('blog.index') || request()->routeIs('blog.create') || request()->routeIs('blog.edit')? 'side-menu--active' : ''}}">
                            <div class="side-menu__icon"><i data-feather="book"></i></div>
                            <div class="side-menu__title"> Blog</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('setting.create')}}"
                           class="side-menu {{request()->routeIs('setting.create')?'side-menu--active' : ''}}">
                            <div class="side-menu__icon"><i data-feather="settings"></i></div>
                            <div class="side-menu__title"> Setting</div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;"
                           class="side-menu {{request()->routeIs('product.index') || request()->routeIs('product.create')|| request()->routeIs('subcategory.index') ||request()->routeIs('category.index') || request()->routeIs('subcategory.create')?'side-menu--active side-menu--open' : ''}} ">
                            <div class="side-menu__icon"><i data-feather="package"></i></div>
                            <div class="side-menu__title"> Product <i data-feather="chevron-down"
                                                                      class="side-menu__sub-icon"></i></div>
                        </a>
                        <ul class="">
                            <li>
                                <a href="{{route('category.index')}}"
                                   class="side-menu {{request()->routeIs('category.index')?'side-menu--active' : ''}}">
                                    <div class="side-menu__icon"><i data-feather="plus-circle"></i></div>
                                    <div class="side-menu__title"> Category</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('subcategory.index')}}"
                                   class="side-menu {{request()->routeIs('subcategory.index') || request()->routeIs('subcategory.create')?'side-menu--active' : ''}}">
                                    <div class="side-menu__icon"><i data-feather="plus-circle"></i></div>
                                    <div class="side-menu__title">Sub Category</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('product.index')}}"
                                   class="side-menu {{request()->routeIs('product.index') || request()->routeIs('product.create')?'side-menu--active' : ''}}">
                                    <div class="side-menu__icon"><i data-feather="plus-circle"></i></div>
                                    <div class="side-menu__title">Product</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('display.users')}}"
                           class="side-menu {{request()->routeIs('display.users')?'side-menu--active' : ''}}">
                            <div class="side-menu__icon"><i data-feather="users"></i></div>
                            <div class="side-menu__title"> Users</div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;"
                           class="side-menu {{request()->routeIs('sendmail.index')|| request()->routeIs('bulkmail.index')||request()->routeIs('emailtemplate.index')||request()->routeIs('emaillogs.index')?'side-menu--active side-menu--open' : ''}} ">
                            <div class="side-menu__icon"><i data-feather="mail"></i></div>
                            <div class="side-menu__title"> Email Marketing <i data-feather="chevron-down"
                                                                              class="side-menu__sub-icon"></i></div>
                        </a>
                        <ul class="{{request()->routeIs('sendmail.index')|| request()->routeIs('bulkmail.index')||request()->routeIs('emailtemplate.index')||request()->routeIs('emaillogs.index')?'side-menu__sub-open' : ''}}">
                            <li>
                                <a href="{{route('sendmail.index')}}"
                                   class="side-menu {{request()->routeIs('sendmail.index')?'side-menu--active' : ''}}">
                                    <div class="side-menu__icon"><i data-feather="send"></i></div>
                                    <div class="side-menu__title"> Send Email</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('bulkmail.index')}}"
                                   class="side-menu {{request()->routeIs('bulkmail.index')?'side-menu--active' : ''}}">
                                    <div class="side-menu__icon"><i data-feather="send"></i></div>
                                    <div class="side-menu__title">Send Bulk Email</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('emaillogs.index')}}"
                                   class="side-menu {{request()->routeIs('emaillogs.index')?'side-menu--active' : ''}}">
                                    <div class="side-menu__icon"><i data-feather="inbox"></i></div>
                                    <div class="side-menu__title">Email Logs</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('emaillogs.index')}}"
                                   class="side-menu {{request()->routeIs('emaillogs.index')?'side-menu--active' : ''}}">
                                    <div class="side-menu__icon"><i data-feather="inbox"></i></div>
                                    <div class="side-menu__title">Email Logs</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{route('condition.index')}}"
                           class="side-menu {{request()->routeIs('condition.index')?'side-menu--active' : ''}}">
                            <div class="side-menu__icon"><i data-feather="info"></i></div>
                            <div class="side-menu__title"> Terms & Conditions</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('question.index')}}"
                           class="side-menu {{request()->routeIs('quesstion.index')?'side-menu--active' : ''}}">
                            <div class="side-menu__icon"><i data-feather="help-circle"></i></div>
                            <div class="side-menu__title"> FAQ</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('all.users.tickets')}}"
                           class="side-menu {{request()->routeIs('all.users.tickets')?'side-menu--active' : ''}}">
                            <div class="side-menu__icon"><i data-feather="message-circle"></i></div>
                            <div class="side-menu__title">Ticket</div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END: Mobile Menu -->

            <div class="flex">
                <!-- BEGIN: Side Menu -->
                <nav class="side-nav">
                    <a href="{{url('/')}}" class="intro-x flex items-center pl-5 pt-4">
                        @if($setting)
                            @if($setting->logo != null)
                                <img alt="Midone Tailwind HTML Admin Template" class="w-6"
                                     src="{{url('/').Storage::url($setting->logo)}}">
                            @else
                                <img alt="Midone Tailwind HTML Admin Template" class="w-6"
                                     src="{{asset('dist/images/logo.svg')}}">
                            @endif
                        @endif

                        <span
                            class="hidden xl:block text-white text-lg ml-3"> {{$setting->short_name ?? 'Company Name'}} </span>
                    </a>
                    <div class="side-nav__devider my-6"></div>
                    <ul>
                        <li>
                            <a href="{{route('admin.index')}}"
                               class="side-menu {{request()->routeIs('admin.index')? 'side-menu--active' : ' '}}">
                                <div class="side-menu__icon"><i data-feather="home"></i></div>
                                <div class="side-menu__title"> Dashboard</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('all.orders')}}"
                               class="side-menu {{request()->routeIs('all.orders') ? 'side-menu--active' : ''}}">
                                <div class="side-menu__icon"><i data-feather="truck"></i></div>
                                <div class="side-menu__title"> All Orders</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('slider.index')}}"
                               class="side-menu {{request()->routeIs('slider.index') || request()->routeIs('slider.create')? 'side-menu--active' : ''}}">
                                <div class="side-menu__icon"><i data-feather="sliders"></i></div>
                                <div class="side-menu__title"> Slider</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('blog.index')}}"
                               class="side-menu {{request()->routeIs('blog.index') || request()->routeIs('blog.create') || request()->routeIs('blog.edit')? 'side-menu--active' : ''}}">
                                <div class="side-menu__icon"><i data-feather="book"></i></div>
                                <div class="side-menu__title"> Blog</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('display.users')}}"
                               class="side-menu {{request()->routeIs('display.users') || request()->routeIs('view.user.order') || request()->routeIs('view.single.order.status')|| request()->routeIs('view.user.orders.status')?'side-menu--active' : ''}}">
                                <div class="side-menu__icon"><i data-feather="users"></i></div>
                                <div class="side-menu__title">Users</div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;"
                               class="side-menu {{request()->routeIs('product.index') || request()->routeIs('product.create')|| request()->routeIs('subcategory.index') ||request()->routeIs('category.index') || request()->routeIs('subcategory.create')?'side-menu--active side-menu--open' : ''}} ">
                                <div class="side-menu__icon"><i data-feather="package"></i></div>
                                <div class="side-menu__title"> Product <i data-feather="chevron-down"
                                                                          class="side-menu__sub-icon"></i></div>
                            </a>
                            <ul class="{{request()->routeIs('product.index') || request()->routeIs('product.create')|| request()->routeIs('subcategory.index') ||request()->routeIs('category.index') || request()->routeIs('subcategory.create')?'side-menu__sub-open' : ''}} ">
                                <li>
                                    <a href="{{route('category.index')}}"
                                       class="side-menu {{request()->routeIs('category.index')?'side-menu--active' : ''}}">
                                        <div class="side-menu__icon"><i data-feather="plus-circle"></i></div>
                                        <div class="side-menu__title"> Category</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('subcategory.index')}}"
                                       class="side-menu {{request()->routeIs('subcategory.index') || request()->routeIs('subcategory.create')?'side-menu--active' : ''}}">
                                        <div class="side-menu__icon"><i data-feather="plus-circle"></i></div>
                                        <div class="side-menu__title">Sub Category</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('product.index')}}"
                                       class="side-menu {{request()->routeIs('product.index') || request()->routeIs('product.create')?'side-menu--active' : ''}}">
                                        <div class="side-menu__icon"><i data-feather="plus-circle"></i></div>
                                        <div class="side-menu__title">Product</div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:;"
                               class="side-menu {{request()->routeIs('sendmail.index')|| request()->routeIs('bulkmail.index')||request()->routeIs('emailtemplate.index')||request()->routeIs('emaillogs.index')||request()->routeIs('template.index')?'side-menu--active side-menu--open' : ''}} ">
                                <div class="side-menu__icon"><i data-feather="mail"></i></div>
                                <div class="side-menu__title"> Email Marketing <i data-feather="chevron-down"
                                                                                  class="side-menu__sub-icon"></i></div>
                            </a>
                            <ul class="{{request()->routeIs('sendmail.index')|| request()->routeIs('template.index')||request()->routeIs('bulkmail.index')||request()->routeIs('emailtemplate.index')||request()->routeIs('emaillogs.index')?'side-menu__sub-open' : ''}}">
                                <li>
                                    <a href="{{route('sendmail.index')}}"
                                       class="side-menu {{request()->routeIs('sendmail.index')?'side-menu--active' : ''}}">
                                        <div class="side-menu__icon"><i data-feather="send"></i></div>
                                        <div class="side-menu__title"> Send Email</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('bulkmail.index')}}"
                                       class="side-menu {{request()->routeIs('bulkmail.index')?'side-menu--active' : ''}}">
                                        <div class="side-menu__icon"><i data-feather="send"></i></div>
                                        <div class="side-menu__title">Send Bulk Email</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('template.index')}}"
                                       class="side-menu {{request()->routeIs('template.index')?'side-menu--active' : ''}}">
                                        <div class="side-menu__icon"><i data-feather="send"></i></div>
                                        <div class="side-menu__title">Email Templates</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('emaillogs.index')}}"
                                       class="side-menu {{request()->routeIs('emaillogs.index')?'side-menu--active' : ''}}">
                                        <div class="side-menu__icon"><i data-feather="inbox"></i></div>
                                        <div class="side-menu__title">Email Logs</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('question.index')}}"
                               class="side-menu {{request()->routeIs('question.index') || request()->routeIs('question.create') || request()->routeIs('question.edit')?'side-menu--active' : ''}}">
                                <div class="side-menu__icon"><i data-feather="help-circle"></i></div>
                                <div class="side-menu__title"> FAQ</div>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('all.users.tickets')}}"
                               class="side-menu {{request()->routeIs('all.users.tickets')?'side-menu--active' : ''}}">
                                <div class="side-menu__icon"><i data-feather="message-circle"></i></div>
                                <div class="side-menu__title">Ticket</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('setting.create')}}"
                               class="side-menu {{request()->routeIs('setting.create')?'side-menu--active' : ''}}">
                                <div class="side-menu__icon"><i data-feather="settings"></i></div>
                                <div class="side-menu__title"> Setting</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('condition.index')}}"
                               class="side-menu {{request()->routeIs('condition.index') || request()->routeIs('condition.create') || request()->routeIs('condition.edit')?'side-menu--active' : ''}}">
                                <div class="side-menu__icon"><i data-feather="info"></i></div>
                                <div class="side-menu__title"> Terms & Conditions</div>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- END: Side Menu -->
                <div class="content">
                    <!-- BEGIN: Top Bar -->
                    <div class="top-bar">
                        <!-- BEGIN: Breadcrumb -->
                        <div class="-intro-x breadcrumb mr-auto hidden sm:flex"><a href="{{route('admin.index')}}"
                                                                                   class="">Application</a> <i
                                data-feather="chevron-right" class="breadcrumb__icon"></i> <a
                                href="{{Request::url()}}"
                                class="breadcrumb--active">@yield('pageName')</a>
                        </div>
                        <!-- END: Breadcrumb -->

                        <!-- BEGIN: Notifications -->
                        <div class="intro-x dropdown mr-auto sm:mr-6">
                            <div class="dropdown-toggle notification notification--bullet cursor-pointer"><i
                                    data-feather="bell"
                                    class="notification__icon dark:text-gray-300"></i>
                            </div>
                            <div class="notification-content pt-2 dropdown-box">
                                <div class="notification-content__box dropdown-box__content box dark:bg-dark-6">
                                    <div class="notification-content__title"><a href="{{route('all.orders')}}"> Order
                                            Notifications </a></div>
                                    @forelse($notifications as $notify)
                                        <div class="cursor-pointer relative flex items-center mt-3 markAsRead"
                                             data-value="{{$notify->id}}">
                                            <div class="w-12 h-12 flex-none image-fit mr-1">
                                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full"
                                                     src="{{asset('dist/images/profile-4.jpg')}}">
                                                <div
                                                    class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                                            </div>
                                            <div class="ml-2 overflow-hidden">
                                                <div class="flex items-center">
                                                    <a href="javascript:;"
                                                       class="font-medium truncate mr-5">{{$notify->user->name}}</a>
                                                    <div
                                                        class="text-xs text-gray-500 ml-auto whitespace-no-wrap">{{$notify->created_at->diffForHumans()}}</div>
                                                </div>
                                                <div class="w-full truncate text-gray-600">New Order
                                                    For {{$notify->services}}
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <h1>No Notifications yet</h1>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <!-- END: Notifications -->
                        <!-- BEGIN: Account Menu -->
                        <div class="intro-x dropdown w-8 h-8">
                            <div
                                class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                                <img alt="Midone Tailwind HTML Admin Template"
                                     src="{{asset('dist/images/profile-1.jpg')}}">
                            </div>
                            <div class="dropdown-box w-56">
                                <div class="dropdown-box__content box bg-theme-38 dark:bg-dark-6 text-white">
                                    <div class="p-4 border-b border-theme-40 dark:border-dark-3">
                                        <div class="font-medium">{{auth()->user()->name}}</div>
                                        <div class="text-xs text-theme-41 dark:text-gray-600">Admin</div>
                                    </div>
                                    <div class="p-2">
                                        <a href="{{route('profile.index')}}"
                                           class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                            <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                                        <a href="{{route('profile.create')}}"
                                           class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                            <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                                    </div>
                                    <div class="p-2 border-t border-theme-40 dark:border-dark-3">
                                        <form method="POST" action="{{route('logout')}}"
                                              class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                            @csrf
                                            <button type="submit" style="display:flex ;align-items:center"><i
                                                    data-feather="toggle-right"
                                                    class="w-4 h-4 mr-2"></i>
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Account Menu -->
                    </div>
                    <!-- END: Top Bar -->
                @show
                @yield('content')

                <!-- BEGIN: Dark Mode Switcher-->
                    <div data-url="{{route('update.dark.mode')}}"
                         class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
                        <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
                        <div class="dark-mode-switcher__toggle border"></div>
                    </div>
                    <!-- END: Dark Mode Switcher-->
                </div>
            </div>
        </body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
        <script
            src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=['AIzaSyBJqm6zQMGSJ8IOv-T-9630T5xROMUtAP0']&libraries=places"></script>

        <script type="text/javascript" src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript"
                src=" https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script src="{{asset('dist/js/app.js')}}"></script>
        <script type="text/javascript" src="{{asset('dist/js/toastr.min.js')}}"></script>
        <!-- select 2 -->
        @yield('script')
        <script>
            $(document).ready(function () {
                $('#example').DataTable({
                    language: {
                        paginate: {
                            sNext: '<i class="fa fa-forward datatable-arrow"></i>',
                            sPrevious: '<i class="fa fa-backward datatable-arrow"></i>',
                            //    sFirst: '<i class="fa fa-step-backward"></i>',
                            //    sLast: '<i class="fa fa-step-forward"></i>'
                        }
                    }
                });
            });

            $(document).on('click','.markAsRead',function () {
                let id = $(this).data('value');
                $(this).remove();
                $.ajax({
                    method: 'GET',
                    dataType: 'json',
                    url: 'order/mark/read/' + id,
                });
            });

            @if(session()->has('notify'))
            Toastify({
                text: "{{ session()->get('notify') }}",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#0d93e9",
                stopOnFocus: true,
            }).showToast();
            @endif

            @if(session()->has('success'))
            Toastify({
                text: "{{ session()->get('success') }}",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#006400",
                stopOnFocus: true,
            }).showToast();
            @endif

            @if(session()->has('failed'))
            Toastify({
                text: "{{ session()->get('failed') }}",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#d70707",
                stopOnFocus: true,
            }).showToast();
            @endif
        </script>
        </html>
