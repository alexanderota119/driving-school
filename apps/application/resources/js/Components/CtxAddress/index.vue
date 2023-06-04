<template>
    <div class="col-grow">
        <ctx-input
            :name="`${name}.street1`"
            :required="required"
            label="Street 1"
        />
        <ctx-input :name="`${name}.street2`" label="Street 2" />
        <ctx-input
            v-if="false"
            :name="`${name}.street2`"
            :required="false"
            label="Street 2"
        />
    </div>
    <div class="row">
        <div class="col-grow">
            <ctx-input
                :name="`${name}.city`"
                :required="required"
                label="City"
            />
        </div>
        <div class="col-grow">
            <api-ctx-select
                :name="`${name}.state_id`"
                :required="required"
                label="State"
                model="states"
            />
        </div>
        <div class="col-grow">
            <ctx-input
                :name="`${name}.zipcode`"
                :required="required"
                fill-mask
                label="Zipcode"
                mask="##### ####"
            />
        </div>
    </div>
</template>
<script lang="ts">
export default {
    name: 'CtxAddress',
};
</script>
<script lang="ts" setup>
import { withDefaults } from 'vue';

interface Props {
    name: string;
    required?: boolean;
}

withDefaults(defineProps<Props>(), {
    name: 'address',
    required: true,
});
</script>
