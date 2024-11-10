<div class="modal-header">
    <h5 class="modal-title" id="biddingInfoModalLabel">Bidder's Information</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <!-- <span aria-hidden="true">&times;</span> -->
    </button>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="input-group" style="font-weight: 700; width: 100%;">
                    <span class="input-group-addon" id="bid_amount"
                        style="min-width: 30%; text-align: start; font-size: 1.5rem;">Bid amount</span>
                    <input type="text" readonly value="₱ {{number_format($data->amount)}}" class="form-control"
                        id="bid_amount" style="font-size: 1.5rem; display:flex; align-items:center;"
                        aria-describedby="bid_amount">
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="input-group" style="width: 100%">
                    <span class="input-group-addon" id="full_name" style="min-width: 30%; text-align: start;">Full
                        name</span>
                    <input type="text" readonly value="{{$data->full_name}}" class="form-control" id="full_name"
                        aria-describedby="full_name">
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="input-group" style="width: 100%">
                    <span class="input-group-addon" id="mobile_number" style="min-width: 30%; text-align: start;">Mobile
                        number</span>
                    <input type="text" readonly value="{{$data->mobile_number}}" class="form-control" id="mobile_number"
                        aria-describedby="mobile_number">
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="input-group" style="width: 100%">
                    <span class="input-group-addon" id="email_add" style="min-width: 30%; text-align: start;">Email
                        address</span>
                    <input type="text" readonly value="{{$data->email_add}}" class="form-control" id="email_add"
                        aria-describedby="email_add">
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="input-group" style="width: 100%">
                    <span class="input-group-addon" id="birth_date" style="min-width: 30%; text-align: start;">Birth
                        date</span>
                    <input type="text" readonly value="{{$data->birth_date}}" class="form-control" id="birth_date"
                        aria-describedby="birth_date">
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="input-group" style="width: 100%">
                    <span class="input-group-addon" id="source_of_income"
                        style="min-width: 30%; text-align: start;">Source of income</span>
                    <input type="text" readonly value="{{$data->source_of_income}}" class="form-control"
                        id="source_of_income" aria-describedby="source_of_income">
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="input-group" style="width: 100%">
                    <span class="input-group-addon" id="company_name" style="min-width: 30%; text-align: start;">Company
                        name</span>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="input-group" style="width: 100%">
                    <span class="input-group-addon" id="address"
                        style="min-width: 30%; text-align: start;">Address</span>
                    <input type="text" readonly value="{{$data->address}}" class="form-control" id="address"
                        aria-describedby="address">
                </div>
            </div>
            <div style="display:flex; justify-content: end;  gap: 5px;" class="mt-3">
                <a class="btn btn-default" href="{{ 'http://127.0.0.1:8000/storage/e_signature/' . $data->e_signature }}" target="_blank">View e-signature</a>
                <a class="btn btn-default" href="{{ 'http://127.0.0.1:8000/storage/govt_id/' . $data->govt_id}}" target="_blank">View govt. ID (with address)</a>
                <a class="btn btn-default" href="{{ 'http://127.0.0.1:8000/storage/selfie_id/' . $data->selfie_with_id}}" target="_blank">View selfie with ID</a>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    @php
        // check if user is banned
        $dateBanned = new \DateTime($data->date_banned);

        // Add 6 months to the date_banned
        $dateBanned->modify('+6 months');

        // Get the current date and time
        $currentDate = new \DateTime();
    @endphp

    @if($currentDate > $dateBanned || $data->date_banned == null)
        <div style="display:flex; justify-content: space-between;">
            <a data-action="ban_user" class="action-button btn btn-danger">Ban user</a>
    @else
        <div style="display:flex; justify-content: end;">
    @endif
            <div>
                @if(($data->status == 'pending' || $data->status == 'approved') || $bid_position == 1)


                    <div class="btn-group dropup" role="group" style="margin: 0;">
                        <button type="button" class="btn dropdown-toggle btn-primary" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Actions
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" style="text-align:center;">
                            @if($data->status != 'approved')
                                <li><a data-action="approve" class="action-button bg-success">Accept Offer</a></li>
                            @endif
                            @if($data->status != 'sold')
                                <li><a data-action="sold" class="action-button bg-info">Sold</a></li>
                            @endif
                            @if($data->status != 'defaulted')
                                <li><a data-action="default" class="action-button bg-secondary">Default</a></li>
                            @endif
                            @if($data->status != 'backed_out')
                                <li><a data-action="backout" class="action-button bg-secondary">Backed-out</a></li>
                            @endif
                            @if($data->status != 'rejected')
                                <li><a data-action="reject" class="action-button bg-danger">Reject</a></li>
                            @endif

                            <!-- @if($data->status != 'active')
                                    <li><a data-action="active" class="action-button bg-success">Active</a></li>
                                @endif
                                @if($data->status != 'accepted_offer')
                                    <li><a data-action="accepted-offer" class="action-button bg-success">Accepted Offer</a></li>
                                @endif
                                @if($data->status != 'failed_bid')
                                    <li><a data-action="failed-bid" class="action-button bg-danger">Failed Bid</a></li>
                                @endif -->

                        </ul>
                    </div>
                @endif
                <a type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        jQuery(() => {
            $(`.action-button`).on(`click`, async e => {
                e.preventDefault();
                if (confirm("Please confirm to proceed")) {
                    const action = $(e.target).attr(`data-action`);
                    try {
                        const response = await fetch(`/bidding/info/{{$data->product_id}}/cycle/{{$data->bidding_cycle_id}}/bidder/{{$data->id}}/${action}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $(`input[name="_token"]`).val()
                            },
                        })

                        if (response.ok) {
                            alert('Action success');
                            window.location.reload();
                        }
                    } catch (error) {
                        alert('Error updating data, please retry.')
                        $(`#biddingInfoModal`).modal(`close`)
                    }
                }
            })
        })
    </script>
    <style>
        .mt-3 {
            margin-top: 12px;
        }

        .mt-4 {
            margin-top: 16px;
        }

        .action-button {
            cursor: pointer;
        }
    </style>
