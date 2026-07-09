<div class="grid gap-6 md:grid-cols-2 xl:grid-cols-5">

    <x-qf.resource-card
        title="CPU"
        :value="number_format($overview['system']['cpu']['usage'], 1) . '%'"
        :subtitle="'Load Average ' . $overview['system']['cpu']['load']['1m']"
        :progress="$overview['system']['cpu']['usage']"
        status="Healthy"
        variant="success"
        icon="🖥️" />

    <x-qf.resource-card
        title="Memory"
        :value="number_format($overview['system']['memory']['usage'], 1) . '%'"
        :subtitle="$overview['system']['memory']['used_mb'] . ' / ' . $overview['system']['memory']['total_mb'] . ' MB'"
        :progress="$overview['system']['memory']['usage']"
        status="Healthy"
        variant="success"
        icon="🧠" />

    <x-qf.resource-card
        title="Storage"
        :value="number_format($overview['system']['disk']['usage'], 1) . '%'"
        :subtitle="$overview['system']['disk']['used_gb'] . ' / ' . $overview['system']['disk']['total_gb'] . ' GB'"
        :progress="$overview['system']['disk']['usage']"
        status="Healthy"
        variant="success"
        icon="💾" />

    @php
        $iface = collect($overview['system']['network']['interfaces'] ?? [])
            ->except('lo')
            ->first();
    @endphp

    <x-qf.resource-card
        title="Network"
        :value="isset($iface['rx_mb']) ? number_format($iface['rx_mb'],1).' MB' : 'N/A'"
        subtitle="Live Interface"
        progress="100"
        status="Live"
        variant="info"
        icon="🌐" />

    <x-qf.resource-card
        title="Uptime"
        :value="$overview['system']['uptime']['days'] . ' Days'"
        :subtitle="$overview['system']['uptime']['human']"
        progress="100"
        status="Running"
        variant="success"
        icon="⏱️" />

</div>
