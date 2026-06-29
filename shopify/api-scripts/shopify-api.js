require('dotenv').config();
const axios = require('axios');

const STORE = process.env.SHOPIFY_STORE;
const TOKEN = process.env.SHOPIFY_ACCESS_TOKEN;

const client = axios.create({
  baseURL: `https://${STORE}/admin/api/2025-01/graphql.json`,
  headers: {
    'X-Shopify-Access-Token': TOKEN,
    'Content-Type': 'application/json'
  }
});

// Fetch Products
async function fetchProducts() {
  const query = `
  {
    products(first: 10) {
      edges {
        node {
          id
          title

          variants(first: 10) {
            edges {
              node {
                id
                title
                price
                inventoryQuantity
              }
            }
          }
        }
      }
    }
  }`;

//   const res = await client.post('', { query });

//   console.log('\n=== PRODUCTS REPORT ===');

//   res.data.data.products.edges.forEach(product => {

    const res = await client.post('', { query });

console.log(JSON.stringify(res.data, null, 2));

if (res.data.errors) {
  console.log(res.data.errors);
  return;
}

if (!res.data.data || !res.data.data.orders) {
  console.log('Orders not accessible.');
  return;
}

console.log('\n=== ORDER REPORT ===');

res.data.data.orders.edges.forEach(order => {

    console.log('\nProduct:', product.node.title);

    product.node.variants.edges.forEach(variant => {
      console.log(
        `Variant: ${variant.node.title}
Price: ${variant.node.price}
Inventory: ${variant.node.inventoryQuantity}`
      );
    });
  });
}

// Create Product
async function createProduct() {
  const mutation = `
  mutation {
    productCreate(product: {
      title: "FitWear Demo Product"
    }) {
      product {
        id
        title
      }

      userErrors {
        field
        message
      }
    }
  }`;

  const res = await client.post('', { query: mutation });

  console.log('\n=== PRODUCT CREATED ===');
  console.log(res.data.data.productCreate);
}

// Fetch Orders Report
async function fetchOrders() {
  const query = `
  {
    orders(first: 5) {
      edges {
        node {
          name
          totalPriceSet {
            shopMoney {
              amount
            }
          }
          customer {
            firstName
            lastName
          }
        }
      }
    }
  }`;

  try {
    const res = await client.post('', { query });

    // Print complete Shopify response
    console.log(JSON.stringify(res.data, null, 2));

    // Check for GraphQL errors
    if (res.data.errors) {
      console.log('GraphQL Errors:');
      console.log(res.data.errors);
      return;
    }

    // Check if orders exist
    if (!res.data.data || !res.data.data.orders) {
      console.log('Orders not accessible.');
      return;
    }

    console.log('\n=== ORDER REPORT ===');

    res.data.data.orders.edges.forEach(order => {
      console.log(`
Order: ${order.node.name}
Customer: ${order.node.customer?.firstName || ''} ${order.node.customer?.lastName || ''}
Total: ${order.node.totalPriceSet.shopMoney.amount}
      `);
    });

  } catch (err) {
    console.log('API Error:');

    if (err.response) {
      console.log(JSON.stringify(err.response.data, null, 2));
    } else {
      console.log(err.message);
    }
  }
}

// // Fetch Orders Report
// async function fetchOrders() {
//   const query = `
//   {
//     orders(first: 5) {
//       edges {
//         node {
//           name
//           totalPriceSet {
//             shopMoney {
//               amount
//             }
//           }
//           customer {
//             firstName
//             lastName
//           }
//         }
//       }
//     }
//   }`;

//   const res = await client.post('', { query });

//   console.log('\n=== ORDER REPORT ===');

//   res.data.data.orders.edges.forEach(order => {
//     console.log(`
// Order: ${order.node.name}
// Customer: ${order.node.customer?.firstName || ''} ${order.node.customer?.lastName || ''}
// Total: ${order.node.totalPriceSet.shopMoney.amount}
//       `);
//   });
// }

// Run functions
(async () => {
  await fetchProducts();
  await createProduct();
  await fetchOrders();
})();
