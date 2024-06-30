@foreach ($refills as $refill)
<tr>
    <td>{{ $refill->created_at->format('j F Y  g:i a') }}</td>
    <td>{{ $refill->adAccount->ad_acc_name }}</td>
    <td>{{ $refill->adAccount->dollar_rate }}</td>
    <td>{{ $refill->amount_dollar }}</td>
    <td>{{ $refill->amount_taka }}</td>
    <td>{{ $refill->payment_method }}</td>
    <td>{{ $refill->assign }}</td>
    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'employee')
    <td class="text-center">
        @if ($refill->sent_to_agency == 0 && $refill->payment_method != 'Transferred')
        <form action="{{ route('refill.sendToAgency', $refill->id) }}" method="post" style="display:inline-block;">
            @csrf
            <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to send this refill application to the agency?')">
                Send to Agency
            </button>
        </form>
        @else
        <span class="badge custom-badge-success" id="buttonText">Sent</span>
        @endif
    </td>
    @endif
    <td>
        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'employee')
        <form action="{{ route('refills.updateStatus', $refill->id) }}" method="post">
            @csrf
            @method('PATCH')
            <select name="status" class="form-select-sm custom-status" style="width: 90px;" onchange="this.form.submit()">
                <option value="pending" {{ $refill->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $refill->status == 'approved' ? 'selected' : '' }}>Approved
                </option>
                <option value="rejected" {{ $refill->status == 'rejected' ? 'selected' : '' }}>Rejected
                </option>
            </select>
        </form>
        @elseif(auth()->user()->role == 'customer')
        @if ($refill->status == 'pending')
        <span class="badge custom-badge-info">Pending</span>
        @endif
        @if ($refill->status == 'approved')
        <span class="badge custom-badge-success">Approved</span>
        @endif
        @if ($refill->status == 'rejected')
        <span class="badge badge-danger px-3 py-1">Rejected</span>
        @endif
        @endif
    </td>
    <td>
        <span class="d-flex align-items-center">
            <a href="{{ route('refills.show', $refill->id) }}" data-toggle="tooltip" data-placement="top" title="View">
                <i class="fa fa-eye color-muted m-r-5"></i>
            </a>
            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manager')
            
            <a href="{{ route('refills.edit', $refill->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                <i class="fa fa-pencil color-muted m-r-5 ml-3"></i>
            </a>
            @endif

            @if (auth()->user()->role == 'admin')
            <div class="basic-dropdown ml-2">
                <div class="dropdown">
                    <i class="fa-solid fa-ellipsis btn btn-sm" data-toggle="dropdown"></i>
                    <div class="dropdown-menu">
                        <a class="dropdown-item">
                            <form action="{{ route('refills.destroy', $refill->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Refill Application?')">Delete</button>
                            </form>
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </span>
    </td>
</tr>
@endforeach

@if ($refills->hasMorePages())
<tr>
    <td colspan="10" class="text-center">
        <button class="btn load-more" data-page="{{ $refills->currentPage() + 1 }}">Load More</button>
    </td>
</tr>
@endif