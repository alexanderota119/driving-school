<template>
    <div v-if="phones.length > 0">
        <strong v-if="label" v-text="theLabel" />
        <ul class="list-unstyled mb-32">
            <li v-for="phone in phones" class="text-primary">
                ({{ phoneType(phone) }})
                <a
                    :href="`tel:${phone.number_fmt}`"
                    v-text="phone.number_fmt"
                />
            </li>
        </ul>
    </div>
</template>
<script lang="ts" setup>
import { computed } from 'vue';

interface Props {
    phones: App.Models.Phone[];
    label?: string;
}

const props = defineProps<Props>();

const phoneType = (phone: App.Models.Phone): string => {
    return phone.can_receive_sms ? 'Cell' : 'Other';
};

const theLabel = computed(() => {
    if (!props.label) {
        return '';
    }

    if (props.phones.length == 1) {
        return props.label;
    }

    return `${props.label}s`;
});
</script>
