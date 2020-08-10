import React from 'react';
import { Edit, TextInput, TabbedForm, FormTab, required } from 'react-admin';

const OrganizationTitle = ({ record }) =>
    record ? `Boite ${record.name}` : null;

export const OrganizationEdit = (props) => {
    return (
        <Edit title={<OrganizationTitle />} {...props}>
            <TabbedForm>
                <FormTab label="L'entreprise">
                    <TextInput
                        fullWidth
                        label="Nom de l'entreprise"
                        source="name"
                        validate={required()}
                    />
                    <TextInput
                        fullWidth
                        label="Url du logo"
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
                        label="Email principal"
                        source="email"
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
                        validate={required()}
                    />
                </FormTab>
                <FormTab label="Adresse">
                    <TextInput
                        source="location.address.streetAddress"
                        label="Rue"
                        fullWidth
                        validate={required()}
                    />
                    <TextInput
                        source="location.address.postalCode"
                        label="Code Postal"
                        fullWidth
                        validate={required()}
                    />
                    <TextInput
                        source="location.address.addressLocality"
                        label="Ville"
                        fullWidth
                        validate={required()}
                    />
                </FormTab>
            </TabbedForm>
        </Edit>
    );
};
