<template>
    <q-field
        v-model="fieldValue"
        :clearable="true"
        :hint="help"
        :label="label"
        class="q-ma-md"
        outlined
        stack-label
        standout
    >
        <template #control>
            <Datepicker
                :id="name"
                v-model="fieldValue"
                :autoApply="['time', 'date'].includes(type)"
                :clearable="false"
                :enable-time-picker="['time', 'datetime'].includes(type)"
                :max-date="maxDate"
                :min-date="minDate"
                :min-time="minTime"
                :minutesIncrement="minutesIncrement"
                :no-today="false"
                :placeholder="placeholder"
                :required="required"
                :timePicker="type === 'time'"
                class="self-center full-width no-outline no-border no-shadow no-box-shadow"
                format="MM/dd/yyyy HH:mm a"
                inputClassName="q-ml-none no-outline no-border no-shadow no-box-shadow"
                utc
            />
        </template>
        <input-error-display #error :error="error" />
    </q-field>
</template>
<script lang="ts" setup>
import { ModelIdType } from '@/types/form';
import { getError, onChangeDate } from '@/utils';
import { EdDrivingComputedRef } from '@/utils/types/form';
//type = "datetime-local";
// @link - https://vue3datepicker.com/api/props/
import Datepicker from '@vuepic/vue-datepicker';
import { inject, ref } from 'vue';

const datetime = ref('');

interface PropTypes {
    name: string;
    id?: string;
    placeholder?: string;
    label?: string;
    required?: boolean;
    disabled?: boolean;
    minDate?: Date | string;
    maxDate?: Date | string;
    minTime?: Date | string;
    minutesIncrement?: number;
    type: 'date' | 'time' | 'datetime';
}

const props = withDefaults(defineProps<PropTypes>(), {
    placeholder: 'Click to select',
    type: 'datetime',
    minutesIncrement: 5,
});

const fieldValue = inject<EdDrivingComputedRef<ModelIdType>>(onChangeDate)(
    props.name,
);
const error = (inject(getError) as EdDrivingComputedRef)(props.name);
</script>
