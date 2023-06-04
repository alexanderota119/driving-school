<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="alert alert-success" role="alert">Status</div>

                    You are logged in!

                    <h3>{{ tenant_name || 'tenant' }}!</h3>
                    <div>
                        <pre>{{ JSON.stringify(tenant, null, 2) }}</pre>
                    </div>
                    <div>
                        auth:
                        <pre>{{ JSON.stringify(auth, null, 2) }}</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script lang="ts" setup>
defineProps<{
    tenant_name: string;
    tenant: App.Models.Tenant;
    auth: {
        check: boolean;
        user: App.Models.User;
    };
}>();
</script>
