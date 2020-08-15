import React from 'react';
import { Edit, SimpleForm, TextInput, required } from 'react-admin';

const CreativeWorkTitle = ({ record }) =>
    record ? `Edition de ${record.name}` : null;

export const CreativeWorkEdit = (props) => {
    return (
        <Edit title={<CreativeWorkTitle />} {...props}>
            <SimpleForm>
                <TextInput
                    fullWidth
                    label="Nom"
                    source="name"
                    validate={required()}
                />
                <TextInput
                    fullWidth
                    multiline
                    label="Résumé"
                    source="disambiguatingDescription"
                    validate={required()}
                />
                <TextInput
                    fullWidth
                    multiline
                    label="Présentation"
                    source="abstract"
                />
            </SimpleForm>
        </Edit>
    );
};
