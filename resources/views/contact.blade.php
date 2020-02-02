@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Contacts</h1>
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
                        <th scope="col">Subject</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-right w-25" >Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <th scope="row">{{ $contact->id }}</th>
                            <td>{{ $contact->name  }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>
                                <span class="badge badge-{{ $contact->reply ? 'success' : 'warning' }}">
                                    {{ $contact->reply ? 'REPLIED' : 'WAITING TO REPLY' }}
                                </span>
                            </td>
                            <td class="text-right">
                                @if(!$contact->reply)
                                    <button class="btn btn-info reply" data-id="{{ $contact->id }}">Reply</button>
                                @else
                                    <button class="btn btn-info show-reply-message"data-message="{{ $contact->reply }}">Reply Message</button>
                                @endif
                                <button class="btn btn-info show-info-message" data-message="{{ $contact->message }}">View Message</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @if(!$contacts->count())
                    <p class="text-center">No items created..</p>
                @endif

                {{ $contacts->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalInfoMessage">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="word-break: break-word">
                <p class="text p-4"></p>
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
                <form action="{{ route('contact.reply') }}" method="POST">
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
            $('.show-info-message').click(function () {
                let message = $(this).attr('data-message');
                let modal = $('#modalInfoMessage');
                modal.find('.text').text(message);
                modal.modal('show');
            });

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
