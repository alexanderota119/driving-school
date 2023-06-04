<template>
    <div class="row full-width">
        <ctx-dropdown
            :default-value="1"
            :options="[{ value: 1, text: '+1 USA' }]"
            label="Country code"
            name="country-code"
        />
        <div class="col-grow">
            <q-input
                v-model="fieldValue"
                :autocomplete="autocomplete"
                :disabled="disabled"
                :help="help"
                :hint="help"
                :label="label"
                :placeholder="placeholder"
                :required="required"
                class="q-ma-md"
                fill-mask
                mask="(###) ### - #### e\xt #####"
                outlined
                type="tel"
                unmasked-value
            />
        </div>
    </div>
</template>
<script lang="ts" setup>
import { ModelIdType } from '@/types/form';
import { formStateUpdate, getError } from '@/utils';
import { EdDrivingComputedRef } from '@/utils/types/form';
import { inject } from 'vue';

interface Props {
    name: string;
    placeholder?: string;
    autocomplete?: string;
    required?: boolean;
    description?: string;
    label?: string;
    disabled?: boolean;
    help?: string;
}

const props = withDefaults(defineProps<Props>(), {
    autocomplete: 'on',
});

const fieldValue = inject<EdDrivingComputedRef<ModelIdType>>(formStateUpdate)(
    props.name,
);
const error = (inject(getError) as EdDrivingComputedRef)(props.name);
</script>
