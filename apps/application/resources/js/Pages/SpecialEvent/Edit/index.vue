<template>
    <CtxForm
        :action="`/special_events/${special_events.id}`"
        :form="special_events"
        add-submit-button
        method="put"
    >
        <Form />
    </CtxForm>
</template>
<script lang="ts" setup>
import Form from '../Form/index.vue';

defineProps<{
    special_events: App.Models.SpecialEvent;
}>();
</script>
