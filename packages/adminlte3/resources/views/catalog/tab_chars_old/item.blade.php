<tr data-id="{{ $char->id }}">
    <td style="width: 70px">
        <i class="fa fa-ellipsis-v"></i>
        <i class="fa fa-ellipsis-v"></i>
    </td>
    <td>{{ $char->name }}</td>
    <td>{{ $char->value }}</td>
    <td><a href="{{ route('admin.catalog.product-del-char', $char->id) }}" onclick="delProductChar(this, event)">
            <i class="fa fa-trash text-red"></i></a>
    </td>
</tr>
