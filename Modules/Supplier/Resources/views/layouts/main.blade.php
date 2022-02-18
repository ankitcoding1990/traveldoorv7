
<x-theme.head />


<style media="screen">
  .custom-breadcrumb{
    display: inline-block;
    width: 100%;
  }
  .custom-breadcrumb-button{
    float: right;
    position: relative;
    top: -1em!important;
    right: 1em!important;
  }
</style>
<body class="hold-transition light-skin sidebar-mini theme-rosegold onlyheader">
    <x-loader />
    <div class="wrapper">
        {{-- TopNav --}}
        <x-main.header />
        {{-- /TopNav --}}

        <div class="content-wrapper">

            <div class="container-full clearfix position-relative">

                {{-- includeNav --}}
                <x-main.navbar />
                {{-- /includeNav --}}

                <div class="content">

                    <div class="content-header">
                        <div class="align-items-center">
                          {{-- custom breadcrumb --}}
                            <div class="mr-auto custom-breadcrumb">
                                <h3 class="page-title">@yield('title')</h3>
                                <div class="d-block">
                                  {{-- button --}}
                                  <div class="custom-breadcrumb-button">
                                      @yield('breadcrumb-button')
                                  </div>
                                  {{-- /button --}}
                                    <nav class="d-inline-block align-items-center">
                                        <ol class="breadcrumb">
                                          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i> Dashboard</a></li>
                                          @isset($breadcrumbs)
                                            @if (is_array($breadcrumbs))
                                              @foreach ($breadcrumbs as $key => $breadcrumb)
                                                @empty ($breadcrumb['link'])
                                                  <li class="breadcrumb-item active" aria-current="page">
                                                    {{ $breadcrumb['title'] }}
                                                  </li>
                                                @else
                                                  <li class="breadcrumb-item"><a href="{{ $breadcrumb['link'] }}"><i class="mdi mdi-home-outline"></i> {{ $breadcrumb['title'] }}</a></li>
                                                @endempty
                                              @endforeach
                                            @endif
                                          @endisset
                                        </ol>
                                    </nav>


                                </div>



                            </div>
                            <!-- <div class="right-title">
                                <div class="dropdown">
                                    <button class="btn btn-outline dropdown-toggle no-caret" type="button"
                                        data-toggle="dropdown"><i class="mdi mdi-dots-horizontal"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-share"></i>Activity</a>
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-email"></i>Messages</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="mdi mdi-help-circle-outline"></i>FAQ</a>
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-settings"></i>Support</a>
                                        <div class="dropdown-divider"></div>
                                        <button type="button" class="btn btn-rounded btn-success">Submit</button>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>

                    {{-- content --}}

                    {{-- /content --}}
                    @yield('main')


                </div>
            </div>
        </div>


        @include('mains.includes.footer')
</body>
  <x-theme.scripts />

  {{-- @stack('scripts') --}}



</html>
