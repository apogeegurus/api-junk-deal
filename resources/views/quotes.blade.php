@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quotes</h1>
    </div>
@endsection


@section('content')
    <div class="card shadow mb-4 col-12">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" style="table-layout: fixed">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Date</th>
                        <th scope="col" class="text-right w-25">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quotes as $quote)
                        <tr>
                            <th scope="row">{{ $quote->id }}</th>
                            <td>{{ $quote->name  }}</td>
                            <td>{{ $quote->email }}</td>
                            <td>{{ $quote->phone }}</td>
                            <td>{{ $quote->date }}</td>
                            <td class="text-right">
                                @if(!$quote->reply)
                                    <button class="btn btn-info reply" data-id="{{ $quote->id }}">Reply</button>
                                @else
                                    <button class="btn btn-info show-reply-message" data-message="{{ $quote->reply }}">Reply Message</button>
                                @endif
                                    <button class="btn btn-info show-info" data-json="{{  json_encode($quote) }}">View Details</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @if(!$quotes->count())
                    <p class="text-center">No items created..</p>
                @endif

                {{ $quotes->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalInfo">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card-body">
                    <ul class="list-group list-group-flush" style="overflow-wrap: break-word;">
                        <li class="list-group-item"><b>Name:</b> <span class="name"></span></li>
                        <li class="list-group-item"><b>Email:</b> <span class="email"></span></li>
                        <li class="list-group-item"><b>Phone:</b> <span class="phone"></span></li>
                        <li class="list-group-item"><b>Zip code:</b> <span class="zip_code"></span></li>
                        <li class="list-group-item"><b>Description:</b> <span class="description"></span></li>
                        <li class="list-group-item"><b>Date:</b> <span class="date"></span></li>
                        <li class="list-group-item"><b>Submitted Date:</b> <span class="submit_date"></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalInfoReply">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="word-break: break-word">
                <p class="text p-4"></p>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalReply">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-4">
                <form action="{{ route('quotes.reply') }}" method="POST">
                    @csrf
                    <input type="hidden" class="contact_id" name="id">
                    <div class="form-group">
                        <label for="phone">Reply Message</label>
                        <textarea type="text" class="form-control" id="phone" name="message" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">REPLY</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('.show-info').click(function () {
                let data = JSON.parse($(this).attr('data-json'));
                let modal = $('#modalInfo');
                modal.find('.name').text(data.name);
                modal.find('.email').text(data.email);
                modal.find('.phone').text(data.phone);
                modal.find('.zip_code').text(data.zip_code);
                modal.find('.description').text(data.description);
                modal.find('.date').text(data.date);
                modal.find('.submit_date').text(data.created_at);

                modal.modal('show');
            })

            $('.show-reply-message').click(function () {
                let message = $(this).attr('data-message');
                let modal = $('#modalInfoReply');
                modal.find('.text').text(message);
                modal.modal('show');
            });

            $('.reply').click(function () {
                let ID = $(this).attr('data-id');
                let modal = $('#modalReply');
                modal.find('.contact_id').val(ID);
                modal.modal('show');
            })
        })
    </script>
@endpush
