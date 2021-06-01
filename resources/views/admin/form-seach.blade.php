
                        {{-- <form class="navbar-form">
                            <div class="input-group no-border">
                                <input type="text" value="" class="form-control" placeholder="Search...">
                                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                        </form> --}}

@if (isset($navbarSeach))

    @switch($navbarSeach)
        @case('invoice')
        <form method="GET" action="{{ url('/invoice') }}" accept-charset="UTF-8" class="navbar-form" role="search">
            <div class="input-group no-border">
                <select class="form-control form-control-sm" name="building" required>
                    <option value="{{ !empty(request('building')) ? request('building') : ''}}">
                        {{ !empty(request('building')) ? request('building') : 'เลือกตึก...'}}</option>
                    <option value="A">&nbsp;&nbsp;&nbsp;ตึก A</option>
                    <option value="B">&nbsp;&nbsp;&nbsp;ตึก B</option>
                </select>
                <input type="text" class="form-control form-control-sm" name="number" placeholder="ค้นหาจากเลขห้อง...."
                    value="{{ request('number') }}" size="30" required>
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                    <i class="material-icons">search</i>
                    <div class="ripple-container"></div>
                </button>
            </div>
        </form>
        @break

        @case('lease')
            <form method="GET" action="{{ url('/lease') }}" accept-charset="UTF-8" role="search" class="navbar-form">
                <div class="input-group no-border">
                    <input type="text" value="{{ request('search') }}"  name="search" class="form-control"
                        placeholder="ค้นหาจากรหัสบัตรประชาชน..." onkeyup="autoTab2(this,1)" required>
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </div>
            </form>
        @break

        @case('maintenance')
            <form method="GET" action="{{ url('/maintenance') }}" accept-charset="UTF-8" role="search" class="navbar-form">
                <div class="input-group no-border">
                    <input type="text" value="{{ request('search') }}"  name="search" class="form-control" placeholder="Search..." required>
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </div>
            </form>
        @break

        @case('room')
            <form method="GET" action="{{ url('/room') }}" accept-charset="UTF-8" class="navbar-form" role="search">
                <div class="input-group no-border">
                    <input type="text" value="{{ request('search') }}" name="search" class="form-control" placeholder="Search..." required>
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </div>
            </form>
        @break

        @case('user')
            <form method="GET" action="{{ url('/user') }}" accept-charset="UTF-8" class="navbar-form" role="search">
                <div class="input-group no-border">
                    <input type="text" value="{{ request('search') }}" name="search" class="form-control" placeholder="คนหาจากชื่อ..." required>
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </div>
            </form>
        @break
    @endswitch
@endif

