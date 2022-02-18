<!-- Left side column. contains the logo and sidebar -->

<aside class="main-sidebar">

    <!-- sidebar-->

    <section class="sidebar">
        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="link-a">
                <a href="{{ route('supplier.dashboard') }}">
                    <i class="ti-dashboard"></i>
                    <span>Home</span>
                </a>
            </li>
            {{-- @dd(auth()->guard('supplier')->user()->id); --}}
            @if (auth()->guard('supplier')->user()->checkActiveSupplier())
            
                @if (count($services) > 0)
                    @foreach ($services as $service)
                        <li class="link-a">
                            <a href="{{ url('/supplier/'.strtolower($service->name)) }}">
                                <i class="ti-dashboard"></i>
                                <span>{{ $service->name }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif

                <li class="link-a">
                    <a href="{{ url('supplier-bookings') }}">
                        <i class="ti-ticket"></i>
                        <span>Bookings</span>
                    </a>
                </li>

                <li class="link-a">
                    <a href="{{ url('my-wallet-own-supplier') }}">
                        <i class="ti-wallet"></i>
                        <span>My Wallet</span>
                    </a>
                </li>

                <li class="link-a">
                    <a href="{{ route('activity.index') }}">
                        <i class="ti-settings"></i>
                        <span>Serice Management</span>
                    </a>
                </li>
            @endif
        </ul>
    </section>
</aside>
