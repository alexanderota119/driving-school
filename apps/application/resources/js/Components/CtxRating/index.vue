<template>
    <q-field :label="label" class="q-ma-md" outlined stack-label standout>
        <template #control>
            <q-rating
                v-model="fieldValue"
                :icon="icons"
                :max="rangeEnd"
                :min="rangeStart"
                color="green-5"
                size="3.5em"
            />
        </template>
    </q-field>
</template>
<script lang="ts">
export default {
    name: 'CtxRating',
};
</script>
<script lang="ts" setup>
import { ModelIdType } from '@/types/form';
import { range } from 'lodash';
import { computed, inject, withDefaults } from 'vue';
import { formStateUpdate, getError } from '@/utils';
import { EdDrivingComputedRef } from '@/utils/types/form';

interface Props {
    name?: string;
    placeholder?: string;
    required?: boolean;
    description?: string;
    label?: string;
    disabled?: boolean;
    rangeStart?: number;
    rangeEnd?: number;
    rangeStep?: number;
    starIcon?: string;
    starSelectedIcon?: string;
}

const props = withDefaults(defineProps<Props>(), {
    rangeStart: 1,
    rangeEnd: 5.1,
    rangeStep: 1,
    starIcon: 'far fa-star',
    starSelectedIcon: 'fas fa-star',
    disabled: false,
    name: 'rating',
    label: 'Rating',
});

let fieldValue = inject<EdDrivingComputedRef<ModelIdType>>(formStateUpdate)(
    props.name,
);
const error = (inject(getError) as EdDrivingComputedRef)(props.name);

const icons = [
    'sentiment_very_dissatisfied',
    'sentiment_dissatisfied',
    'sentiment_satisfied',
    'sentiment_very_satisfied',
];

const ratingNumbers = range(props.rangeStart, props.rangeEnd, props.rangeStep);

const handleRatingSelected = (selectedRating: number) => {
    if (props.disabled) {
        return;
    }

    fieldValue.value = selectedRating;
};

const description = computed(() => {
    return `Selected value is ${fieldValue}`;
});
</script>
