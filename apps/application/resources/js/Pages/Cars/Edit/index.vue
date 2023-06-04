<template>
    <CtxForm
        :action="`/cars/${car.id}`"
        :form="car"
        add-submit-button
        method="put"
    >
        <Form :is-edit="car.id" />
    </CtxForm>
</template>
<script lang="ts" setup>
import Form from '../Form/index.vue';

defineProps<{
    car: App.Models.Car;
}>();
</script>
