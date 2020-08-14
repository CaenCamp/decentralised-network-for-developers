import React from 'react';
import { Edit, SimpleForm, TextInput, required, ReferenceArrayInput, SelectArrayInput } from 'react-admin';

const PeopleTitle = ({ record }) =>
    record ? `Edition des informations de ${record.name}` : null;

export const PeopleEdit = (props) => {
    return (
        <Edit title={<PeopleTitle />} {...props}>
            <SimpleForm>
                <TextInput
                    fullWidth
                    label="Nom"
                    source="familyName"
                    validate={required()}
                />
                <TextInput
                    fullWidth
                    label="Prénom"
                    source="givenName"
                    validate={required()}
                />
                <TextInput
                    fullWidth
                    label="Url de la photos"
                    source="image"
                />
                <TextInput
                    fullWidth
                    label="Url du site web"
                    source="url"
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
                    source="description"
                />
                <ReferenceArrayInput label="Membre de" source="memberOf" reference="organizations">
                    <SelectArrayInput optionText="name" />
                </ReferenceArrayInput>
            </SimpleForm>
        </Edit>
    );
};
