<template>
    <div v-if="pageActions" class="page-actions">
        <ed-button
            :href="`/${model}/create`"
            action-type="create"
            class="q-mb-md"
        />
    </div>
    <div class="table-responsive-md q-mb-sm">
        <q-pull-to-refresh @refresh="refresh">
            <q-table
                v-model:pagination="pagination"
                :columns="allHeaders"
                :grid="quasar.screen.xs"
                :per-page="50"
                :rows="items"
                :rows-per-page-options="rowsPerPageOptions"
                bordered
                class="my-sticky-header-table"
                flat
                virtual-scroll
            >
                <template v-slot:body-cell-updated_at="{ value }">
                    <td>
                        <time>{{ value }}</time>
                    </td>
                </template>
                <template v-slot:body-cell-actions="{ row, rowIndex }">
                    <td
                        v-if="addStandardButtons"
                        class="full-width row no-wrap justify-center items-center content-between q-py-sm"
                    >
                        <slot
                            :index="rowIndex"
                            :row="row"
                            name="more-actions"
                        />

                        <TableButton
                            :href="`/${model}/${row.id}/edit`"
                            icon="edit"
                            title="Edit"
                        />
                        <TableButton
                            v-if="false"
                            :href="`/${model}/${row.id}`"
                            icon="eye"
                            title="View"
                        />
                        <TableButton
                            icon="trash-alt"
                            title="Delete"
                            @click="deleteButton(row.id)"
                        />
                    </td>
                </template>
            </q-table>
        </q-pull-to-refresh>

        <pre v-if="debug">{{ items }}</pre>
    </div>
</template>
<script lang="ts">
export default {
    name: 'DSTable',
    inheritAttrs: false,
    customOptions: {},
};
</script>
<script lang="ts" setup>
import { userDatetime } from '@/utils/helpers/date';
import { get } from 'lodash';
import { QTable, useQuasar } from 'quasar';
import { computed, ref, withDefaults } from 'vue';
import TableButton from './TableButton';
import { Inertia } from '@inertiajs/inertia';
import { TableHeaderType, TableHeadersType } from '@/types/table';
import { Button } from '@/Components';
import TableHeader from '@/Components/Table/TableHeaders';
import useGlobal from '@/utils/useGlobal';
import { toTitleCase, ucFirst } from '@/utils/helpers/String';

const quasar = useQuasar();

interface Props extends QTable {
    name: string;
    items: App.Models.Tenant[] | any[];
    headers: TableHeadersType<any>;
    model?: string;
    pageActions?: boolean;
    addStandardButtons?: boolean;
    hover?: boolean;
    striped?: boolean;
    bordered?: boolean;
    debug?: boolean;
}

type MethodGetColumnData = (
    record: string,
    header: any,
    index: number,
) => string;

const props = withDefaults(defineProps<Props>(), {
    pageActions: true,
    addStandardButtons: true,
    hover: true,
    striped: true,
    bordered: true,
});

const pagination = ref(1);

const rowsPerPageOptions = computed<number[]>(() => {
    if (quasar.screen.gt.sm) {
        return quasar.screen.gt.xs ? [10, 20, 30] : [50];
    }

    return quasar.screen.gt.xs ? [10, 20] : [50];
});

const tableClassProps = computed(() => {
    return {
        'table-hover': props.hover,
        'table-striped ': props.striped,
        'table-bordered': props.bordered,
    };
});

const getColumnData: MethodGetColumnData = (record, header, index) => {
    const columnValue = get(record, header.column, header.defaultValue || '');

    if (header.render) {
        return header.render(columnValue, {
            record,
            header,
            index,
            columnValue,
        });
    }

    return columnValue;
};

const deleteButton = (id: number) => {
    if (confirm('Sure?')) {
        Inertia.delete(`/${props.model}/${id}`);
    }
};

const allHeaders = computed(() => {
    const headers = props.headers.map(h => ({
        align: 'center',
        ...h,
    }));

    const tmpHeaders = [
        ...headers,
        {
            label: 'Updated At',
            name: 'updated_at',
            align: 'center',
            field: row => userDatetime(row.updated_at),
        },
        {
            label: '',
            align: 'center',
            name: 'actions',
            field: 'actions',
        },
    ];

    console.log({ tmpHeaders });

    return tmpHeaders;
});

const { setTitle, addBreadcrumb } = useGlobal();
setTitle(`${toTitleCase(props.name)} Manage`);

addBreadcrumb({ title: toTitleCase(props.name, false) });
addBreadcrumb({ title: 'Manage' });

const wrapCsvValue = (
    val: any,
    formatFn: any = undefined,
    row: any = undefined,
) => {
    let formatted = formatFn ? formatFn(val, row) : val;

    formatted = formatted ? String(formatted) : '';

    formatted = formatted.split('"').join('""');
    /**
     * Excel accepts \n and \r in strings, but some other CSV parsers do not
     * Uncomment the next two lines to escape new lines
     */
    // .split('\n').join('\\n')
    // .split('\r').join('\\r')

    return `"${formatted}"`;
};

const exportTable = () => {
    // naive encoding to csv format
    // const content = [columns.map(col => wrapCsvValue(col.label))]
    //     .concat(
    //         rows.map(row =>
    //             columns
    //                 .map(col =>
    //                     wrapCsvValue(
    //                         typeof col.field === 'function'
    //                             ? col.field(row)
    //                             : row[
    //                                   col.field === void 0
    //                                       ? col.name
    //                                       : col.field
    //                               ],
    //                         col.format,
    //                         row,
    //                     ),
    //                 )
    //                 .join(','),
    //         ),
    //     )
    //     .join('\r\n');
    //
    // const status = exportFile('table-export.csv', content, 'text/csv');
    //
    // if (status !== true) {
    //     quasar.notify({
    //         message: 'Browser denied file download...',
    //         color: 'negative',
    //         icon: 'warning',
    //     });
    // }
};

const refresh = async (done: any) => {
    await new Promise(resolve => {
        Inertia.reload({
            preserveState: true,
            onFinish: resolve,
        });
    });

    done();
};
</script>
