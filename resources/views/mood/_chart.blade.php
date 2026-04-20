<div class="chart-container-flex">
    @foreach($chartData as $data)
    <div class="chart-column-item">
        <span class="count-number">{{ $data['count'] }}</span>
        <div class="bar-tube shadow-inset">
            <div class="bar-progress" 
                 style="height: {{ $data['barHeight'] }}%; background: {{ $data['color'] }};">
            </div>
        </div>
        <div class="mood-emoji-footer">{{ $data['emoji'] }}</div>
    </div>
    @endforeach
</div>