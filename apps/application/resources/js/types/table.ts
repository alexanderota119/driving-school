type RowProps = {
    [key: string]: any;
};

type FieldCallback = (row: RowProps) => string;

export interface TableHeaderType<T> {
    label: string;
    name?: keyof T | string;
    field: keyof T | string | FieldCallback;
    defaultValue?: string;
    align?: 'left' | 'center' | 'right';

    render?(column: string, record: T): string;
}

export type TableHeadersType<T> = TableHeaderType<T>[];
