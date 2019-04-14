@extends('layouts.middle-layouts')

@section('title')
    Daftar Program
@endsection  

<style>
* {
  margin: 0;
  padding: 0;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}


img{
    width: 100%;
    height: auto;
}

.tab__nav-item{
    padding-left: 55px !important;
}

ul { list-style-type: none; }


.accordion {
  width: 100%;
  margin: 30px auto 20px;
  background: #B8D8E0;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}

.accordion .link {
  cursor: pointer;
  display: block;
  padding: 15px 15px 15px 42px;
  color: #4D4D4D;
  font-size: 14px;
  font-weight: 700;
  border-bottom: 1px solid #CCC;
  position: relative;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  transition: all 0.4s ease;
}

.accordion li:last-child .link { border-bottom: 0; }

.accordion li i {
  position: absolute;
  top: 16px;
  left: 12px;
  font-size: 18px;
  color: #595959;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  transition: all 0.4s ease;
}

.accordion li i.fa-chevron-down {
  right: 12px;
  left: auto;
  font-size: 16px;
}

.accordion li.open .link { color: #b63b4d; }

.accordion li.open i { color: #b63b4d; }

.accordion li.open i.fa-chevron-down {
  -webkit-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg);
}

/**
 * Submenu
 -----------------------------*/


.submenu {
  display: none;
  background: #FCF5EF;
  font-size: 14px;
}

</style>

@section('content')    
    <section class="section-1">
            <div class="row">
                <div class="col-lg-6">
            <div class="card responsive">
                <img src="{{$program->getFoto()}}">
                <div class="container mt-2">
                    <p>{{$program->title}}</p><br>
                    <span class="badge badge-succes">{{$program->area_name}}</span><hr>
                    <span>{{$program->brief_explanation}}</span>

                    <table class="table table--bordered table--responsive">
                        <tbody>
                            <tr>
                                <td>Donasi Dibuat</td>
                                <td>{{$program->start_time}}</td>
                            </tr>
                            <tr>
                                <td>Berakhir Pada</td>
                                <td>{{$program->time_is_up}}</td>
                            </tr>
                            <tr>
                                <td>Target Donasi</td>
                                <td>{{$program->donation_target}}</td>
                            </tr>
                            <tr>
                                <td>Donasi Terkumpul</td>
                                <td>{{$program->donation_collected}}</td>
                            </tr>
                            <tr>
                                <td>Nomor Rekening Penampungan</td>
                                <td>{{$program->shelter_account_number}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab">
                <div class="tab-header">
                  <ul class="tab__navigation">
                    <li class="tab__nav-item active" data-tab="#tab1-1">Deskripsi Program</li>
                    <li class="tab__nav-item" data-tab="#tab1-2">Laporan & Perkembangan</li>
                  </ul>
                </div>

                <div class="tab-body">
                  <div class="tab__content" id="tab1-1" style="display: flex;">
                    <p>{!! $program->description !!}</p>
                  </div>

                  <div class="tab__content" id="tab1-2" style="display: none;">
                    <a href="/laporanperkembangan/create/{{$program->id}}">Buat Laporan Baru</a>


                    <ul id="accordion" class="accordion">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($devs as $dev)
                        <li>
                          <div class="link"><i class="fa fa-database"></i>UPDATE #{{$i}}<i class="fa fa-chevron-down"></i></div>
                          <ul class="submenu">
                              <div class="container">
                            <p class="pt-2">{!! $dev->description !!}</p>
                              </div>
                        </ul>
                        </li>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                    </ul>

                  </div>
                </div>
            </div>
            </div>

            <div class="col-lg-6">

                <div class="box box--dark">
                    <div class="box-header">
                      <h3>Pendonasi</h3>
                    </div>
                    <div class="box-body pt-0 px-0 responsive">
                      <table class="table--dark">
                        <thead>
                          <tr>
                            <th>Nama Donatur</th>
                            <th>Nominal Donasi</th>
                            <th>Bukti Pembayaran</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($program->donatur as $donatur)
                          <tr>
                            <td>{{$donatur->nama_donatur}}</td>
                            <td>{{$donatur->nominal_donasi}}</td>
                            @if ($donatur->bukti_pembayaran == '')
                                <td><p class="badge badge-green">Belum Konfirmasi</p></td>
                            @else    
                            <td>{{$donatur->bukti_pembayaran}}</td>
                            @endif

                            @if ($donatur->isVerified == 0)
                                <td><a class="btn btn-light" href="/verify/{{$donatur->id}}">Verify</a></td>
                            @else
                                <td><p class="badge badge-primary">Diverifikasi</p></td>
                            @endif
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="pagination-wrapper clearfix">
                      <ul class="pagination float--right">
                        <li class="pagination-item"><a class="active">1</a></li>
                        <li class="pagination-item"> <a>2</a></li>
                        <li class="pagination-item"> <a>3</a></li>
                        <li class="pagination-item"> <a>Next</a></li>
                      </ul>
                    </div>
                  </div>

            </div>



            </div>
    </section>

    @section('script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script>
            $(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
	}	

	var accordion = new Accordion($('#accordion'), false);
});

        </script>
    @endsection

@endsection