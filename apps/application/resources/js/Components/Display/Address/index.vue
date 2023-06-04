<template>
    <strong v-if="label" v-text="label" />
    <address class="mb-2">
        <div><strong v-text="address.street1" /></div>
        <div><strong v-text="address.street2" /></div>
        <div>{{ address.city }}, {{ address.state.abbr }} address.zipcode</div>
    </address>
</template>
<script lang="ts" setup>
interface Props {
    address: App.Models.Address;
    label?: string;
}

defineProps<Props>();
</script>
