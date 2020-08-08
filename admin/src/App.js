import React from "react";
import { ResourceGuesser, HydraAdmin, fetchHydra, hydraDataProvider } from "@api-platform/admin";
import { Resource } from 'react-admin';
import { parseHydraDocumentation } from "@api-platform/api-doc-parser";

import Organization from './Organizations';

const entrypoint = process.env.REACT_APP_API_ENTRYPOINT;

const dataProvider = hydraDataProvider(
    entrypoint,
    fetchHydra,
    parseHydraDocumentation,
    true // useEmbedded parameter
);

export default () => (
    <HydraAdmin
        dataProvider={ dataProvider }
        entrypoint={ entrypoint }
    >
        <ResourceGuesser name="people" />
        <ResourceGuesser name="organizations" {...Organization} />
  </HydraAdmin>
);
