<form action="{{ route($route) }}" method="GET" id="yearForm">
    <select id="selectAcademicYear" name="academicYears" onchange="document.getElementById('yearForm').submit()"
        class="py-1 text-[16px] w-full rounded border border-[#D9DBE3] px-6">
        @if ($academicYears->isEmpty())
            <option value="" disabled selected>No Existing academic year</option>
        @else
            <option value="" {{ empty($request->academicYears) ? 'selected' : '' }}>
                All</option>
            @foreach ($academicYears as $acadYear)
                <option value="{{ $acadYear->id }}"
                    {{ $acadYear->id == old('academicYears', $request->academicYears) ? 'selected' : '' }}>
                    {{ $acadYear->year_name }}
                </option>
            @endforeach
        @endif
    </select>
</form>
