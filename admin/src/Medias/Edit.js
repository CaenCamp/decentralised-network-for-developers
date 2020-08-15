import React from 'react';
import { Edit, SimpleForm, TextInput, required } from 'react-admin';

const MediaTitle = ({ record }) =>
    record ? `Edition de ${record.id}` : null;

export const MediaEdit = (props) => {
    return (
        <Edit title={<MediaTitle />} {...props}>
            <SimpleForm>
                <TextInput
                    fullWidth
                    label="Description"
                    source="abstract"
                    validate={required()}
                />
            </SimpleForm>
        </Edit>
    );
};
