
<div class="h-screen overflow-y-auto">
    <x-layouts.app.sidebar :title="$title ?? null"  >
        <flux:main>
            {{ $slot }}
        </flux:main>

        @stack('js')

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @if (session()->has('swal'))
                    let alerts = @json(session('swal'));

                    // Si solo hay una alerta, conviértela en un array
                    if (!Array.isArray(alerts)) {
                        alerts = [alerts];
                    }

                    function showAlerts(index) {
                        if (index < alerts.length) {
                            Swal.fire(alerts[index]).then(() => {
                                showAlerts(index + 1);
                            });
                        }
                    }

                    showAlerts(0);
                @endif
            });
        </script>

    </x-layouts.app.sidebar>
</div>