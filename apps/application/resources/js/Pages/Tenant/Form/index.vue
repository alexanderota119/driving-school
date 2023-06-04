<template>
    <div class="row">
        <div class="col-md-8">
            <form-section title="Tenant Information">
                <ctx-input :disabled="isEdit" label="Tenant Key" name="id" />

                <ctx-input label="Tenant Name" name="name" />
            </form-section>

            <form-section
                help="These won't save until you click the save button"
                title="Domains"
            >
                <q-list bordered separator>
                    <q-item
                        v-for="(domain, index) in domains"
                        :key="`domain.${index}`"
                        :data-domain-id="domain.id"
                    >
                        <ctx-input
                            :label="`Domain ${index}`"
                            :name="`domains.${index}.domain`"
                            class="full-width"
                        />
                    </q-item>
                    <q-item>
                        <q-btn color="secondary" @click="emits('add-domain')"
                            >Add Domain
                        </q-btn>
                    </q-item>
                </q-list>
            </form-section>
        </div>
        <div class="col-grow">
            <ctx-file-upload label="Logo" name="file" />
            <ctx-color label="Background Color" name="bgcolor" />
            <ctx-color label="Text Color" name="fgcolor" />
        </div>
    </div>
</template>
<script lang="ts" setup>
import { Domain } from '@/utils/types/extended-models';

withDefaults(
    defineProps<{
        domains?: Domain[] | any;
        isEdit: boolean;
    }>(),
    {
        domains: [],
    },
);

const emits = defineEmits(['add-domain']);

// add methods or variables here
</script>
