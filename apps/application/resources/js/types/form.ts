export type ModelIdType = number | string;

export interface BaseModel {
    id?: ModelIdType;
    tenant_id?: string;

    created_at?: string;
    updated_at?: string;
    deleted_at?: string;
}

export interface FormDataType {
    address?: AddressType;
    addresses?: AddressType[];
    notes?: NoteType[];

    [key: string]: any;
}

export interface AddressType extends BaseModel {
    street1: string;
    street2: string;
    street3: string;
    city: string;
    state_id: number;
    zipcode: string;
    addressable_id: number;
    addressable_type: string;
}

export interface NoteType extends BaseModel {
    text: string;
}
